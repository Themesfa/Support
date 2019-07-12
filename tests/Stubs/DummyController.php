<?php namespace Themesfa\Support\Tests\Stubs;

use Themesfa\Support\Http\Controller;

/**
 * Class     DummyController
 *
 * @package  Themesfa\Support\Tests\Stubs
 * @author   Themesfa <info@themesfa.net>
 */
class DummyController extends Controller
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    protected $template = 'welcome';

    /* -----------------------------------------------------------------
     |  Actions
     | -----------------------------------------------------------------
     */

    public function index()
    {
        return 'Dummy';
    }

    public function getOne($slug)
    {
        if ($slug !== 'super') {
            return $this->pageNotFound('Super dummy not found !');
        }

        return 'Super dummy';
    }
}
