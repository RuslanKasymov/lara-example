<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Routing\Middleware\ThrottleRequests;

abstract class TestCase extends BaseTestCase
{
    // TODO: Exchange RefreshDatabase to transaction start/rollback
    // TODO: Add parallel execution for tests
    // TODO: Add TestCaseUnit without RefreshDatabase fot unit-test cases
    use CreatesApplication, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->refreshDatabase();

        $this->withoutMiddleware(
            ThrottleRequests::class
        );
    }
}
