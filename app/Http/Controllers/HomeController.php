<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Offer;
use App\Models\VisitorStat;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        $featuredProducts = Product::with(['section', 'category', 'brand', 'material', 'images'])
            ->where('featured', true)
            ->where('status', 'active')
            ->limit(8)
            ->get();

        $activeOffers = Offer::where('status', 'active')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->limit(5)
            ->get();

        $siteSettings = SiteSetting::pluck('value', 'key')->toArray();

        return view('pages.home', compact('featuredProducts', 'activeOffers', 'siteSettings'));
    }

    /**
     * Display the about page.
     */
    public function about()
    {
        $siteSettings = SiteSetting::pluck('value', 'key')->toArray();
        
        return view('pages.about', compact('siteSettings'));
    }

    /**
     * Increment visitor counter.
     */
    public function incrementVisitor(Request $request)
    {
        $today = now()->format('Y-m-d');
        
        $visitorStat = VisitorStat::where('date', $today)->first();
        
        if ($visitorStat) {
            $visitorStat->increment('total_visits');
            
            // Check if this is a unique visitor (simplified logic)
            if (!$request->session()->has('visited_today')) {
                $visitorStat->increment('unique_visits');
                $request->session()->put('visited_today', true);
            }
        } else {
            VisitorStat::create([
                'date' => $today,
                'total_visits' => 1,
                'unique_visits' => 1,
            ]);
            $request->session()->put('visited_today', true);
        }

        $totalVisits = VisitorStat::where('date', $today)->value('total_visits') ?? 0;
        
        return response()->json([
            'success' => true,
            'total_visits' => $totalVisits
        ]);
    }
}
