<?php

namespace Klsandbox\ProductRoute\Http\Controllers;

use App\Models\BonusCategory;
use App\Models\Group;
use Excel;
use Illuminate\Http\Request;
use Klsandbox\OrderModel\Models\Product;
use Auth;
use Input;
use Klsandbox\OrderModel\Models\ProductUnit;
use Klsandbox\ProductRoute\Request\CreateProductRequest;
use Klsandbox\ProductRoute\Request\UpdateProductRequest;
use Klsandbox\RoleModel\Role;
use Redirect;
use Session;
use App\Http\Controllers\Controller;

class ProductManagementController extends Controller
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
        $this->middleware('auth');
    }

    public function getEdit(Product $product)
    {
        $groups = Group::all();
        $bonusCategories = BonusCategory::all();
        $units = $product->units()->get();
        $productUnits = ProductUnit::whereNotIn('id', $units->pluck('id'))->get();
        $roles = Role::all();
        $data = [
            'bonusCategories' => $bonusCategories,
            'groups' => $groups,
            'product' => $product,
            'productUnits' => $productUnits,
            'units' => $units,
            'roles' => $roles,
        ];

        return view('product-route::edit-product', $data);
    }

    public function getList()
    {
        return view('product-route::list')
            ->with('products', Product::getAvailableProductList());
    }

    public function getListAll()
    {
        return view('product-route::list')
            ->with('products', Product::getAllProductList());
    }

    public function getCreateProduct()
    {
        $bonusCategories = BonusCategory::all();
        $groups = Group::all();
        $roles = Role::all();

        $data = [
            'bonusCategories' => $bonusCategories,
            'groups' => $groups,
            'roles' => $roles,
        ];

        return view('product-route::create-product', $data);
    }

    /**
     * Save new product
     *
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateProduct(CreateProductRequest $request)
    {
        $inputs = $request->all();

        $file = $request->file('image');
        $destination = public_path() . '/uploads/';
        $extension = $file->getClientOriginalExtension();
        $fileName = bin2hex(random_bytes(32)) . '.' . $extension;
        $file->move($destination, $fileName);

        $inputs['image'] = '/uploads/' . $fileName;
        $inputs = array_except($inputs, ['_token']);

        $inputs['is_available'] = true;
        $this->model->create($inputs);

        Session::flash('success_message', 'Product has been created.');

        return Redirect::to('/products/list');
    }

    /**
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdate(UpdateProductRequest $request, Product $product)
    {
        $inputs = $request->all();

        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $destination = public_path('uploads/');
            $extension = $file->getClientOriginalExtension();
            $fileName = bin2hex(random_bytes(32)) . '.' . $extension;
            $file->move($destination, $fileName);

            $inputs['image'] = 'uploads/' . $fileName;

            if (\File::exists(public_path($product->image))) {
                \File::delete(public_path($product->image));
            }
        }

        $product->update($inputs);

        Session::flash('success_message', 'Product has been updated.');

        return Redirect::to('/products/list');
    }

    public function getDelete(Product $product)
    {
        $this->model->setUnavailable($product->id);

        Session::flash('success_message', 'Product has been deleted.');

        return Redirect::to('/products/list');
    }

    public function units(Request $request, Product $product){
        $units = $product->units;

        //unit that not added to product
        if($request->input('filter') == 'not-in-product') {
            return ProductUnit::whereNotIn('id', $units->pluck('id'))->get();
        }

        return $units;
    }

    public function storeUnits(Request $request, $product)
    {
        $product->units()->attach(
            $request->input('product_unit_id'),
            [
                'quantity' => $request->input('quantity'),
                'quantity_east' => $request->input('quantity_east'),
                'quantity_pickup' => $request->input('quantity_pickup'),
            ]
        );

        if($request->ajax()){
            return $product->units;
        }

        flash()->success('Success!', 'Unit has been added');

        return redirect()->back();
    }

    public function deleteUnits(Request $request, $product, $productUnit)
    {
        $product->units()->detach($productUnit->id);

        if($request->ajax()){
            return $product->units;
        }

        flash()->success('Success!', 'Unit has been deleted');

        return redirect()->back();
    }

    public function viewUnits(Request $request, $product, $productUnit)
    {
        $unit = $product->units->where('id', $productUnit->id)->first();

        return $unit;

    }

    public function updateUnits(Request $request, $product, $productUnit)
    {

        $unit = $product->units->where('id', $productUnit->id)->first();
        $pivot = $request->input('pivot');

        $unit->pivot->update([
            'quantity' => $pivot['quantity'],
            'quantity_east' => $pivot['quantity_east'],
            'quantity_pickup' => $pivot['quantity_pickup'],
        ]);

        if($request->ajax()){
            return $product->units;
        }

        flash()->success('Success!', 'Unit has been updated');

        return redirect()->back();
    }

    public function export()
    {
        return Excel::create('Product list', function($excel) {

            $excel->sheet('Products', function($sheet) {
                $products = Product::all();

                $data = [
                    'products' => $products
                ];

                $sheet->loadView('product-route::export', $data);

            });

        })->export('xls');
    }
}
