@extends('app')

@section('page-header')
    @include('elements.page-header', ['section_title' => 'Products', 'page_title' => 'Edit Product'])
@endsection

@section('content')
    <section class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Edit Product</h2>
        </div>
        <div class="panel-body">
            @include('elements.error-message-partial')

            <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST"
                  action="{{ url('/products/update/' . $product->id) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="col-md-3 control-label">Product Name</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Product Description</label>

                    <div class="col-md-6">
                        <textarea rows="10" class="form-control" name="description">{{ $product->description }}</textarea>
                    </div>
                </div>
                @if(! $config->group_enabled)
                    <div class="form-group">
                        <label class="col-md-3 control-label">Product Price</label>

                        <div class="col-md-6">
                            <input type="number" class="form-control" name="price"
                                   value="{{ $product->productPricing->price }}">
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label for="image" class="control-label col-md-3">Product Image</label>
                    <div class="col-md-6">
                        <img width='40' height='40' src='{{asset($product->image)}}'>
                        <input type="file" class="form-control" name="image" id="image">
                    </div> <!-- end div.col-md-6 -->
                </div> <!-- end div.form-group -->

                <div class="form-group">
                    <label class="col-md-3 control-label">Bonus Category</label>

                    <div class="col-md-6">
                        <select name='bonus_categories_id'>
                            <option value=''>Any</option>
                            @foreach ($bonusCategories as $item)
                                <option value='{{$item->id}}' {{ ($product->bonus_category_id == $item->id) ? 'selected' : '' }}>
                                    {{ $item->friendly_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Max Quantity</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="max_quantity"
                               value="{{ $product->max_quantity }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Min Quantity</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="min_quantity"
                               value="{{ $product->min_quantity }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Hide</label>

                    <div class="col-md-6">
                        <label>
                            <input type="radio" name="hidden_from_ordering" value="1"
                                    {{  (old('hidden_from_ordering', $product->hidden_from_ordering) == '1')  ? 'checked' : '' }}
                            >
                            Yes
                        </label>
                        <label>
                            <input type="radio" name="hidden_from_ordering" value="0"
                                    {{ (old('hidden_from_ordering', $product->hidden_from_ordering) != '1')  ? 'checked' : '' }}
                            >
                            No
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">HQ Product</label>

                    <div class="col-md-6">
                        <label>
                            <input type="radio" name="is_hq" value="1"
                                    {{  (old('is_hq', $product->is_hq) != '0')  ? 'checked' : '' }}
                            >
                            Yes
                        </label>
                        <label>
                            <input type="radio" name="is_hq" value="0"
                                    {{ (old('is_hq', $product->is_hq) == '0')  ? 'checked' : '' }}
                            >
                            No
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">For Customer</label>

                    <div class="col-md-6">
                        <label>
                            <input type="radio" name="for_customer" value="1"
                                    {{  (old('for_customer', $product->for_customer) != '0')  ? 'checked' : '' }}
                            >
                            Yes
                        </label>
                        <label>
                            <input type="radio" name="for_customer" value="0"
                                    {{ (old('for_customer', $product->for_customer) == '0')  ? 'checked' : '' }}
                            >
                            No
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">For new user</label>

                    <div class="col-md-6">
                        <label>
                            <input type="radio" name="new_user" value="1"
                                    {{  (old('new_user', $product->new_user) != '0')  ? 'checked' : '' }}
                            >
                            Yes
                        </label>
                        <label>
                            <input type="radio" name="new_user" value="0"
                                    {{ (old('new_user', $product->new_user) == '0')  ? 'checked' : '' }}
                            >
                            No
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Exipiry Date</label>
                    <div class="col-md-6">
                        <input type="text" name="expiry_date" data-plugin-datepicker
                               data-date-format="dd/mm/yyyy"
                               class="form-control"
                                value="{{ old('expiry_date', $product->expiry_date) }}">
                    </div>
                </div>

                @if($config->group_enabled)
                    <div class="form-group">
                        {{--<label class="col-md-3 control-label">Target Group</label>--}}
                        <div class="col-md-10 col-md-offset-1 column">
                            <table class="table table-bordered table-hover" id="tab_logic">
                                <thead>
                                <tr>
                                <tr>
                                    <th class="text-center" rowspan="2">Group</th>
                                    <th class="text-center" colspan="2">Product Price</th>
                                    <th class="text-center" colspan="2">Delivery</th>
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="1">West Malaysia</th>
                                    <th class="text-center" colspan="1">East Malaysia</th>
                                    <th class="text-center" colspan="1">West Malaysia</th>
                                    <th class="text-center" colspan="1">East Malaysia</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $index = 0 ?>
                                @foreach ($groups as $item)
                                    <?php $index++ ?>
                                    <tr>
                                        <input type="hidden" name="{{ "groups[{$index}][group_id]" }}"
                                               value="{{$item->id}}"/>
                                        <input type="hidden"
                                               name="{{ "groups[{$index}][product_pricing_id]" }}"
                                               value="{{$product->pricingForGroup($item) ? $product->pricingForGroup($item)->id : 0}}"/>
                                        <td>{{ $item->name }}</td>
                                        <td colspan="1">
                                            <input type="number" name="{{ "groups[{$index}][price]" }}"
                                                   value="{{$product->pricingForGroup($item) ? $product->pricingForGroup($item)->price : ''}}"
                                                   placeholder='Price' class="form-control"/>
                                        </td>
                                        <td colspan="1">
                                            <input type="number" name="{{ "groups[{$index}][price_east]" }}"
                                                   value="{{$product->pricingForGroup($item) ? $product->pricingForGroup($item)->price_east : ''}}"
                                                   placeholder='Price' class="form-control"/>
                                        </td>
                                        <td colspan="1">
                                        <input type="number" name="{{ "groups[{$index}][delivery]" }}"
                                               value="{{$product->pricingForGroup($item) ? $product->pricingForGroup($item)->delivery : ''}}"
                                               placeholder='Delivery' class="form-control"/>
                                        </td>
                                        <td colspan="1">
                                            <input type="number" name="{{ "groups[{$index}][delivery_east]" }}"
                                                   value="{{$product->pricingForGroup($item) ? $product->pricingForGroup($item)->delivery_east : ''}}"
                                                   placeholder='Delivery' class="form-control"/>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Product Units</h2>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="#modalAddUnit" class="btn modal-add-unit btn-primary"><i class="fa fa-plus"></i> Add Unit</a>
                </div>
            </div>

            <div id="modalAddUnit" class="modal-block modal-block-primary mfp-hide">
                <form class="form-horizontal" method="post" action="{{ url('products/' . $product->id . '/units') }}"
                    id="formAddUnit">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">Add Unit</h2>
                        </header>
                        <div class="panel-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-3">Unit</label>
                                <div class="col-md-7">
                                    <select class="form-control" name="product_unit_id" required>
                                        <option value="">Select unit</option>
                                        @foreach($productUnits as $productUnit)
                                            <option value="{{ $productUnit->id }}">{{ $productUnit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Quantity</label>
                                <div class="col-md-7">
                                    <input type="number" min="1" name="quantity" value="1" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                        <footer class="panel-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary submit-unit">Confirm</button>
                                    <button class="btn btn-default modal-dismiss">Cancel</button>
                                </div>
                            </div>
                        </footer>
                    </section>
                </form>
            </div>

            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive" id="product-units-container">
                        <div class="table-responsive">
                            <table class="{{isset($table_class) ? $table_class : 'table table-bordered table-striped table-condensed mb-none'}}">
                                <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(! count($units))
                                    <tr>
                                        <td colspan="4" class="text-center"> No Units</td>
                                    </tr>
                                @endif
                                @foreach($units as $unit)
                                    <tr>
                                        <td>{{ $unit->name }}</td>
                                        <td>{{ $unit->description }}</td>
                                        <td>{{ $unit->pivot->quantity }}</td>
                                        <td>
                                            <form method="post" action="{{ url('products/' . $product->id . '/units/' . $unit->id) }}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE"/>
                                                <button type="submit" class="btn btn-danger delete_with_confirm"><i class="fa fa-trash"></i> </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection