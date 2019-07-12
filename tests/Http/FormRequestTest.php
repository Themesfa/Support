<?php namespace Themesfa\Support\Tests\Http;

use Themesfa\Support\Http\FormRequest;
use Themesfa\Support\Tests\TestCase;

/**
 * Class     FormRequestTest
 *
 * @package  Themesfa\Support\Tests\Http
 * @author   Themesfa <info@themesfa.net>
 */
class FormRequestTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_check_validation()
    {
        $response = $this->post('form-request');
        $response->assertStatus(302);

        $response = $this->post('form-request', [
            'name'  => 'Themesfa',
            'email' => 'themesfa@example.com',
        ]);

        $response->assertSuccessful();

        $response->assertJson([
            'name'  => 'Themesfa',
            'email' => 'themesfa@example.com',
        ]);
    }

    /** @test */
    public function it_can_sanitize()
    {
        $response = $this->post('form-request', [
            'name'  => 'Themesfa',
            'email' => ' Themesfa@example.COM ',
        ]);

        $response->assertSuccessful();
        $response->assertJson([
            'name'  => 'Themesfa',
            'email' => 'themesfa@example.com',
        ]);
    }
}
