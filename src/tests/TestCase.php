<?php

namespace Tests;

use Database\Seeders\TestingDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    // Test用Seederファイルを指定
    protected string $seeder = TestingDatabaseSeeder::class;
}
