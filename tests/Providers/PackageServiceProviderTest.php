<?php namespace Themesfa\Support\Tests\Providers;

use Themesfa\Support\Tests\Stubs\InvalidPackageServiceProvider;
use Themesfa\Support\Tests\Stubs\TestPackageServiceProvider;
use Themesfa\Support\Tests\TestCase;

/**
 * Class     PackageServiceProviderTest
 *
 * @package  Themesfa\Support\Tests\Providers
 * @author   Themesfa <info@themesfa.net>
 */
class PackageServiceProviderTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Themesfa\Support\Tests\Stubs\TestPackageServiceProvider */
    private $provider;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->provider = new TestPackageServiceProvider($this->app);

        $this->provider->register();
    }

    public function tearDown(): void
    {
        unset($this->provider);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Illuminate\Support\ServiceProvider::class,
            \Themesfa\Support\ServiceProvider::class,
            \Themesfa\Support\PackageServiceProvider::class,
            \Themesfa\Support\Tests\Stubs\TestPackageServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_register_config()
    {
        $config = config('package');

        static::assertArrayHasKey('foo', $config);
        static::assertEquals($config['foo'], 'bar');
    }

    /** @test */
    public function it_must_throw_a_package_exception()
    {
        $this->expectException(\Themesfa\Support\Exceptions\PackageException::class);
        $this->expectExceptionMessage('You must specify the vendor/package name.');

        (new InvalidPackageServiceProvider($this->app))->register();
    }
}
