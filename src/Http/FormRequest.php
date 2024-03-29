<?php namespace Themesfa\Support\Http;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

/**
 * Class     FormRequest
 *
 * @package  Themesfa\Support
 * @author   Themesfa <info@themesfa.net>
 */
abstract class FormRequest extends BaseFormRequest
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Validate the class instance.
     *
     * @return void
     */
    public function validateResolved()
    {
        parent::validateResolved();

        if (method_exists($this, 'prepareAfterValidation'))
            $this->prepareAfterValidation();
    }
}
