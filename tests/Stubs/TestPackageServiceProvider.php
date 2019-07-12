<?php namespace Themesfa\Support\Tests\Stubs;

use Themesfa\Support\PackageServiceProvider;

/**
 * Class     TestPackageServiceProvider
 *
 * @package  Themesfa\Support\Tests\Stubs
 * @author   Themesfa <info@themesfa.net>
 */
class TestPackageServiceProvider extends PackageServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'package';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register()
    {
        parent::register();

        $this->registerConfig();
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get config folder.
     *
     * @return string
     */
    protected function getConfigFolder()
    {
        return realpath($this->getBasePath().DS.'fixtures'.DS.'config');
    }
}
