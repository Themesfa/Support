<?php namespace Themesfa\Support\Tests\Middleware;

use Themesfa\Support\Tests\TestCase;

/**
 * Class     VerifyJsonRequestTest
 *
 * @package  Themesfa\Support\Tests\Middleware
 * @author   Themesfa <info@themesfa.net>
 */
class VerifyJsonRequestTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_get_json_response()
    {
        $response = $this->call('GET', route('middleware::json.empty'), [], [], [], [
            'CONTENT_TYPE' => 'application/json'
        ]);

        $response->assertSuccessful();
        $response->assertJson(['status' => 'success']);
    }

    /** @test */
    public function it_can_pass_json_middleware()
    {
        foreach (['GET', 'POST', 'PUT', 'DELETE'] as $method) {
            $response = $this->call($method, route('middleware::json.param'), [], [], [], [
                'CONTENT_TYPE' => 'application/json'
            ]);

            $response->assertSuccessful();
            $response->assertJson(['status' => 'success']);
        }
    }

    /** @test */
    public function it_cannot_pass_json_middleware()
    {
        $methods = ['GET', 'POST', 'PUT', 'DELETE'];

        foreach ($methods as $method) {
            $response = $this->call($method, route('middleware::json.param'));

            $response->assertStatus(400);
            $response->assertJson([
                'status'  => 'error',
                'code'    => 400,
                'message' => 'Request must be json',
            ]);
        }
    }
}
