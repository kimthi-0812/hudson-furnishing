<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'model_type',
        'model_id',
        'action',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the action description
     */
    public function getActionDescriptionAttribute()
    {
        $modelName = class_basename($this->model_type);
        
        switch ($this->action) {
            case 'created':
                return "Created {$modelName}";
            case 'updated':
                return "Updated {$modelName}";
            case 'deleted':
                return "Deleted {$modelName}";
            case 'restored':
                return "Restored {$modelName}";
            default:
                return ucfirst($this->action) . " {$modelName}";
        }
    }
}
