<?php namespace Themesfa\Support\Middleware;

use Themesfa\Support\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

/**
 * Class     VerifyJsonRequest
 *
 * @package  Themesfa\Support\Middleware
 * @author   Themesfa <info@themesfa.net>
 */
class VerifyJsonRequest extends Middleware
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     *
     * @var array
     */
    protected $methods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     * @param  string|array|null         $methods
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $methods = null)
    {
        if ($this->isJsonRequestValid($request, $methods)) {
            return $next($request);
        }

        return response()->json([
            'status'  => 'error',
            'code'    => 400,
            'message' => 'Request must be json',
        ], 400);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Validate json Request.
     *
     * @param  Request            $request
     * @param  string|array|null  $methods
     *
     * @return bool
     */
    private function isJsonRequestValid(Request $request, $methods)
    {
        $methods = $this->getMethods($methods);

        return ! (
            in_array($request->method(), $methods) &&
            ! $request->isJson()
        );
    }

    /**
     * Get request methods.
     *
     * @param  string|array|null  $methods
     *
     * @return array
     */
    private function getMethods($methods)
    {
        $methods = $methods ?? $this->methods;

        if (is_string($methods))
            $methods = (array) $methods;

        return is_array($methods) ? array_map('strtoupper', $methods) : [];
    }
}
