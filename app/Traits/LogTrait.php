<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use App\Models\ActivityLog;


trait LogTrait
{
    public function writeLog($action)
    {
        ActivityLog::create([
            'action' => $action,
            'user' => auth()->check() ? auth()->user()->name : 'Guest',
        ]);
        // Log::info($message);
    }
}
