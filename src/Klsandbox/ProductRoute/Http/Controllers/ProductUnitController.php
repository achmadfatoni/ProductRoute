<?php namespace Klsandbox\ProductRoute\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Klsandbox\OrderModel\Models\ProductUnit;
use Klsandbox\ProductRoute\Http\Requests\CreateProductUnitRequest;
use Klsandbox\ProductRoute\Http\Requests\ProductUnitRequest;

class ProductUnitController extends Controller
{
    public function getList()
    {
        $data = [
            'items' => ProductUnit::all(),
        ];

        return view('product-route::units.list', $data);
    }

    public function create()
    {
        return view('product-route::units.create');
    }

    public function store(ProductUnitRequest $request)
    {
        ProductUnit::create($request->all());

        flash()->success('Success!', 'Unit has been created');

        return redirect('products/units');

    }

    public function view($productUnitId)
    {
        $productUnit = ProductUnit::find($productUnitId);

        if (! $productUnit) {
            \App::abort(505, 'Unit not found');
        }

        $data = [
            'productUnit' => $productUnit
        ];

        return view('product-route::units.view', $data);
    }

    public function update(ProductUnitRequest $request, $productUnitId)
    {
        $request->all();
        $productUnit = ProductUnit::find($productUnitId);

        if (! $productUnit) {
            \App::abort(505, 'Unit not found');
        }

        $productUnit->update($request->all());

        flash()->success('Success!', 'Unit has been updated');

        return redirect()->back();
    }

    public function destroy($productUnitId)
    {
        $productUnit = ProductUnit::find($productUnitId);

        if (! $productUnit) {
            \App::abort(505, 'Unit not found');
        }

        $productUnit->delete();

        flash()->success('Success!', 'Product Unit has been deleted');

        return redirect()->back();
    }

}