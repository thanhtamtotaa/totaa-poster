<?php

namespace Totaa\TotaaPoster\Tests;

use Orchestra\Testbench\TestCase;
use Totaa\TotaaPoster\TotaaPosterServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [TotaaPosterServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
