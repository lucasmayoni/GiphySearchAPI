<?php

namespace App\Repositories;

interface AuditLogRepositoryInterface
{
    public function createLog(array $log);
}
