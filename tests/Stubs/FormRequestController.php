<?php namespace Themesfa\Support\Tests\Stubs;

use Themesfa\Support\Http\Controller;
use Themesfa\Support\Http\FormRequest;

/**
 * Class     FormRequestController
 *
 * @package  Themesfa\Support\Tests\Stubs
 * @author   Themesfa <info@themesfa.net>
 */
class FormRequestController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function form(DummyFormRequest $request)
    {
        return $request->all();
    }
}

class DummyFormRequest extends FormRequest
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => ['required', 'string', 'min:6'],
            'email' => ['required', 'string', 'email'],
        ];
    }

    /**
     * Prepare the data before validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'name'  => strtoupper(trim($this->get('name'))),
        ]);
    }

    /**
     * Prepare the data after validation.
     *
     * @return void
     */
    protected function prepareAfterValidation()
    {
        $this->merge([
            'email' => strtolower(trim($this->get('email'))),
        ]);
    }
}
