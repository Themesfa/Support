<?php namespace Themesfa\Support\Providers;

use Themesfa\Support\ServiceProvider;
use Illuminate\Contracts\View\Factory as ViewFactory;

/**
 * Class     ViewComposerServiceProvider
 *
 * @package  Themesfa\Support\Providers
 * @author   Themesfa <info@themesfa.net>
 */
class ViewComposerServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Register the composer classes.
     *
     * @var array
     */
    protected $composerClasses = [
        // 'view-name' => 'class'
    ];

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Boot the view composer service provider.
     */
    public function boot()
    {
        $this->registerComposerClasses();
    }

    /**
     * Register the view composer classes.
     */
    protected function registerComposerClasses()
    {
        foreach ($this->composerClasses as $view => $class) {
            $this->composer($view, $class);
        }
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the view factory instance.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    protected function view()
    {
        return $this->app->make(ViewFactory::class);
    }

    /**
     * Register a view composer event.
     *
     * @param  array|string     $views
     * @param  \Closure|string  $callback
     *
     * @return array
     */
    public function composer($views, $callback)
    {
        return $this->view()->composer($views, $callback);
    }
}
