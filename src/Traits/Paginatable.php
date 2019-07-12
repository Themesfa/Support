<?php namespace Themesfa\Support\Traits;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Trait     Paginatable
 *
 * @package  Themesfa\Support\Traits
 * @author   Themesfa <info@themesfa.net>
 */
trait Paginatable
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Paginate the collection.
     *
     * @param  \Illuminate\Support\Collection  $data
     * @param  \Illuminate\Http\Request        $request
     * @param  int                             $perPage
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function paginate(Collection $data, Request $request, $perPage)
    {
        $page = $request->get('page', 1);
        $path = $request->url();

        return new LengthAwarePaginator(
            $data->forPage($page, $perPage),
            $data->count(),
            $perPage,
            $page,
            compact('path')
        );
    }
}
