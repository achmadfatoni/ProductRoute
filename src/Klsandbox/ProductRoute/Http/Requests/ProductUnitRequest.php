<?php namespace Klsandbox\ProductRoute\Http\Requests;

use App\Http\Requests\Request;

class ProductUnitRequest extends Request
{
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
    public function rules()
    {
        switch ($this->method()){
            case 'POST':
            {
                return [
                    'name'              => 'required|unique:product_units',
                    'sku'              => 'required|unique:product_units',
                ];
            }
            case 'PUT':
            {
                return [
                    'name'              => 'required|unique:product_units,sku,'.$this->segment(2),
                    'sku'              => 'required|unique:product_units,sku,'.$this->segment(2),
                ];
            }
            default:break;
        }
    }

}