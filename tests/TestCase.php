<?php namespace Themesfa\Support\Tests;

use Illuminate\Routing\Router;
use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * Class     TestCase
 *
 * @package  Themesfa\Support\Tests
 * @author   Themesfa <info@themesfa.net>
 */
abstract class TestCase extends BaseTestCase
{
    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get fixture path
     *
     * @param  string  $path
     *
     * @return string
     */
    protected function getFixturesPath($path)
    {
        return __DIR__.'/fixtures/'.$path;
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $this->registerRoutes($app);
    }

    /**
     * Register routes.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    private function registerRoutes($app)
    {
        /** @var Router $router */
        $router = $app['router'];

        $router->group([
            'prefix'    => 'dummy',
            'namespace' => 'Themesfa\\Support\\Tests\\Stubs',
        ], function (Router $router) {
            $router->get('/', [
                'as'    => 'dummy::index',
                'uses'  => 'DummyController@index'
            ]);

            $router->get('{slug}', [
                'as'    => 'dummy::get',
                'uses'  => 'DummyController@getOne'
            ]);
        });

        $router->aliasMiddleware('json', \Themesfa\Support\Middleware\VerifyJsonRequest::class);

        $router->group(['as' => 'middleware::'], function(Router $router) {
            $router->post('form-request', [
                'as'   => 'form-request',
                'uses' => 'Themesfa\Support\Tests\Stubs\FormRequestController@form'
            ]);

            $router->group(['prefix' => 'json', 'as' => 'json.'], function (Router $router) {
                $router->get('/', [
                    'as'         => 'empty',
                    'middleware' => 'json',
                    'uses'       => function () {
                        return response()->json(['status' => 'success']);
                    }
                ]);

                $router->get('param', [
                    'as'         => 'param',
                    'middleware' => 'json:get',
                    'uses'       => function () {
                        return response()->json(['status' => 'success']);
                    }
                ]);

                $router->post('param', [
                    'as'         => 'param',
                    'middleware' => 'json:post',
                    'uses'       => function () {
                        return response()->json(['status' => 'success']);
                    }
                ]);

                $router->put('param', [
                    'as'         => 'param',
                    'middleware' => 'json:put',
                    'uses'       => function () {
                        return response()->json(['status' => 'success']);
                    }
                ]);

                $router->delete('param', [
                    'as'         => 'param',
                    'middleware' => 'json:delete',
                    'uses'       => function () {
                        return response()->json(['status' => 'success']);
                    }
                ]);

//                $router->patch('params', [
//                    'as'         => 'params',
//                    'middleware' => 'json:patch',
//                    'uses'       => function () {
//                        return response()->json(['status' => 'success']);
//                    }
//                ]);
            });
        });
    }
}
