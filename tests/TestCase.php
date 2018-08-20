<?php

namespace Optimus\Posts\Tests;

use PHPUnit\Framework\Assert;
use Optimus\Posts\PostServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [PostServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->withFactories(__DIR__ . '/../database/factories');

        EloquentCollection::macro('assertEquals', function ($collection) {
            $this->zip($collection)->eachSpread(function ($a, $b) {
                Assert::assertTrue($a->is($b));
            });
        });
    }
}
