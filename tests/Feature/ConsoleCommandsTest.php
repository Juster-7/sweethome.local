<?php

namespace Tests\Feature;

use Tests\TestCase;

class ConsoleCommandsTest extends TestCase
{
    public function test_csmfs_command_ClearStorageAndMigrateFreshSeed() {
        $this->artisan('csmfs')->assertSuccessful();
    }
}
