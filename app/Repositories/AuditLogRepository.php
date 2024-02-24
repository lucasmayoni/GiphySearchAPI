<?php

namespace App\Repositories;

use App\Models\AuditLog;

class AuditLogRepository implements AuditLogRepositoryInterface
{

    protected $model;
    public function __construct(AuditLog $auditLog)
    {
        $this->model = $auditLog;
    }

    /**
     * @param array $log
     * @return mixed
     */
    public function createLog(array $log)
    {
        return AuditLog::create($log);
    }
}
