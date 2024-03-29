<?php namespace Themesfa\Support\Tests\Http;

use Themesfa\Support\Tests\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class     ControllerTest
 *
 * @package  Themesfa\Support\Tests\Http
 * @author   Themesfa <info@themesfa.net>
 */
class ControllerTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_do_dummy_stuff()
    {
        $response = $this->get(route('dummy::index'));
        $response->assertSuccessful();

        static::assertEquals('Dummy', $response->getContent());

        $response = $this->get(route('dummy::get', ['super']));
        $response->assertSuccessful();

        static::assertEquals('Super dummy', $response->getContent());
    }

    /** @test */
    public function it_can_throw_four_o_four_exception()
    {
        $response = $this->get(route('dummy::get', ['not-super']));
        $response->assertStatus(404);

        static::assertInstanceOf(NotFoundHttpException::class, $response->exception);
        static::assertSame('Super dummy not found !', $response->exception->getMessage());
    }
}
