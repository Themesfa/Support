<?php namespace Themesfa\Support\Tests\Database;

use Themesfa\Support\Tests\TestCase;

/**
 * Class     ModelTest
 *
 * @package  Themesfa\Support\Tests\Bases
 * @author   Themesfa <info@themesfa.net>
 */
class ModelTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Themesfa\Support\Database\Model */
    protected $model;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->model = new \Themesfa\Support\Tests\Stubs\Models\Product;
    }

    public function tearDown(): void
    {
        unset($this->model);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Test Methods
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Illuminate\Database\Eloquent\Model::class,
            \Themesfa\Support\Database\Model::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->model);
        }
    }

    /** @test */
    public function it_can_get_table_name_without_prefix()
    {
        static::assertSame('products', $this->model->getTable());
    }

    /** @test */
    public function it_can_set_and_get_prefix()
    {
        $this->model->setPrefix($prefix = 'shop_');

        static::assertSame($prefix, $this->model->getPrefix());
        static::assertSame($prefix . 'products', $this->model->getTable());
    }
}
