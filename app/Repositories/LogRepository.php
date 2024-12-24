<?php

namespace App\Repositories;

use App\Interfaces\LogRepositoryInterface;
use App\Models\Log;

class LogRepository implements LogRepositoryInterface
{
    public function save(Log $log, $request) {
        $log->user_id = auth()->id();
        $log->ip = $request->ip();
        $log->url = $request->fullUrl();
        $log->method = $request->method();
        $log->input = $request->getContent();
        $log->agent = $request->header('user-agent');
        $log->save();
    }
}
