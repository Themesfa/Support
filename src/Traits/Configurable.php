<?php namespace Themesfa\Support\Traits;

use Illuminate\Support\Arr;

/**
 * Class     Configurable
 *
 * @package  Themesfa\Support\Traits
 * @author   Themesfa <info@themesfa.net>
 */
trait Configurable
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Config items.
     *
     * @var array
     */
    protected $configs = [];

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the config array.
     *
     * @param  array  $configs
     *
     * @return self
     */
    protected function setConfigs(array $configs)
    {
        $this->configs = $configs;

        return $this;
    }

    /**
     * Get a config item.
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    protected function getConfig($key, $default = null)
    {
        return Arr::get($this->configs, $key, $default);
    }
}
