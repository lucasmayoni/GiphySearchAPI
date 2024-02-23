<?php

namespace App\Repositories;

use App\Models\AuditLog;

class AuditLogRepository implements AuditLogRepositoryInterface
{

    public function createLog(array $log)
    {
        return AuditLog::create($log);
    }
}
