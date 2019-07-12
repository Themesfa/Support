<?php namespace Themesfa\Support\Bases;

use Themesfa\Support\Exceptions\MissingPolicyException;
use Illuminate\Support\Str;

/**
 * Class     Policy
 *
 * @package  Themesfa\Support\Bases
 * @author   Themesfa <info@themesfa.net>
 */
abstract class Policy
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policies.
     *
     * @return array
     */
    public static function policies()
    {
        $abilities = array_values(
            (new \ReflectionClass($instance = new static))->getConstants()
        );

        return array_map(function ($constant) use ($instance) {
            $method = Str::camel(last(explode('.', $constant)).'Policy');

            if ( ! method_exists($instance, $method))
                throw new MissingPolicyException("Missing policy [$method] method in ".get_class($instance).".");

            return $method;
        }, array_combine($abilities, $abilities));
    }
}
