<?php

namespace Tests\Unit;

use App\Models\AuditLog;
use App\Repositories\AuditLogRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuditLogUnitTest extends TestCase
{

    use RefreshDatabase;

    public function testCreateAuditLogRecord() {

        $data = [
            'user_id'=>1,
            'service_url' => 'full_url',
            'request_body' => 'request_body',
            'response_body'=> 'response_body',
            'response_code' => 200,
            'request_source_ip' => '123.1212.1212'
        ];
        $repo = new AuditLogRepository(new AuditLog);
        $created = $repo->createLog($data);
        $this->assertInstanceOf(AuditLog::class, $created);
        $this->assertEquals($data['service_url'], $created->service_url);
    }
}
