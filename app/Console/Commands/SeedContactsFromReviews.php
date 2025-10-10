<?php

namespace App\Console\Commands;

use App\Models\Contact;
use App\Models\Review;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SeedContactsFromReviews extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'contacts:seed-from-reviews {--count=7} {--dry-run}';

    /**
     * The console command description.
     */
    protected $description = 'Cập nhật N bản ghi contacts hiện có bằng tên và email ngẫu nhiên từ reviews (không xóa/chèn mới)';

    public function handle(): int
    {
        $count = (int) $this->option('count');
        $dryRun = (bool) $this->option('dry-run');

        $candidates = Review::inRandomOrder()->limit($count)->get(['name', 'email']);

        if ($candidates->isEmpty()) {
            $this->error('Không tìm thấy dữ liệu trong bảng reviews.');
            return self::INVALID;
        }

        $contacts = \App\Models\Contact::orderBy('id')->limit($count)->get();
        if ($contacts->isEmpty()) {
            $this->error('Không có bản ghi nào trong bảng contacts để cập nhật.');
            return self::INVALID;
        }

        // Số lượng cập nhật = min(contacts hiện có, candidates)
        $limit = min($contacts->count(), $candidates->count(), $count);
        $contacts = $contacts->take($limit);
        $candidates = $candidates->take($limit)->values();

        $rows = [];
        for ($i = 0; $i < $limit; $i++) {
            $contact = $contacts[$i];
            $review = $candidates[$i];
            $rows[] = [
                $contact->id,
                $contact->name . ' -> ' . trim($review->name),
                $contact->email . ' -> ' . trim((string) $review->email),
            ];
        }

        $this->table(['Contact ID', 'Tên (cũ -> mới)', 'Email (cũ -> mới)'], $rows);

        if ($dryRun) {
            $this->info('Dry run: không ghi vào cơ sở dữ liệu.');
            return self::SUCCESS;
        }

        DB::transaction(function () use ($contacts, $candidates, $limit) {
            for ($i = 0; $i < $limit; $i++) {
                /** @var Contact $contact */
                $contact = $contacts[$i];
                /** @var Review $review */
                $review = $candidates[$i];
                $contact->name = trim($review->name);
                $contact->email = trim((string) $review->email) !== '' ? trim((string) $review->email) : $this->fallbackEmailFromName(trim($review->name));
                $contact->save();
            }
        });

        $this->info('Đã cập nhật bảng contacts với dữ liệu mới.');
        return self::SUCCESS;
    }

    private function fallbackEmailFromName(string $name): string
    {
        $base = Str::of($name)
            ->lower()
            ->replaceMatches('/[^a-z\p{L}\s-]/u', '')
            ->replace(['đ','Đ'], ['d','d'])
            ->replaceMatches('/\s+/', ' ')
            ->trim()
            ->replace(' ', '.')
            ->ascii();

        $domainPool = ['example.com', 'mail.com', 'hudson.dev', 'customer.test'];
        $domain = $domainPool[array_rand($domainPool)];
        return (string) $base . '@' . $domain;
    }
}


