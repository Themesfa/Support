<?php namespace Themesfa\Support\Database;

use Themesfa\Support\Traits\PrefixedModel;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class     Model
 *
 * @package  Themesfa\Support\Laravel
 * @author   Themesfa <info@themesfa.net>
 */
abstract class Model extends Eloquent
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use PrefixedModel;
}
