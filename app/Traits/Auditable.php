<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    /**
     * Boot the auditable trait
     */
    public static function bootAuditable()
    {
        static::created(function ($model) {
            $model->logAudit('created', null, $model->getAttributes());
        });

        static::updated(function ($model) {
            $model->logAudit('updated', $model->getOriginal(), $model->getChanges());
        });

        static::deleted(function ($model) {
            if ($model->isForceDeleting()) {
                $model->logAudit('force_deleted', $model->getOriginal(), null);
            } else {
                $model->logAudit('deleted', $model->getOriginal(), null);
            }
        });

        static::restored(function ($model) {
            $model->logAudit('restored', null, $model->getAttributes());
        });
    }

    /**
     * Log audit entry
     */
    protected function logAudit($action, $oldValues = null, $newValues = null)
    {
        // Only log for admin users or if no user is authenticated
        if (Auth::check() && !Auth::user()->is_admin) {
            return;
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'model_type' => get_class($this),
            'model_id' => $this->getKey(),
            'action' => $action,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    /**
     * Get audit logs for this model
     */
    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'model');
    }

    /**
     * Get the latest audit log
     */
    public function latestAuditLog()
    {
        return $this->auditLogs()->latest()->first();
    }
}
