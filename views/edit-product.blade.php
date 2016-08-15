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
                {{ csrf_field() }}

                <div class="form-group">
                    <label class="col-md-4 control-label">Product Name *</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Product Description *</label>
                    <div class="col-md-6">
                        <textarea rows="10" class="form-control" name="description" required>{{ $product->description }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image" class="control-label col-md-4">Product Image</label>
                    <div class="col-md-6">
                        <img width='40' height='40' src='{{asset($product->image)}}'>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Bonus Category</label>
                    <div class="col-md-6">
                        <select name='bonus_category_id'>
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
                    <label class="col-md-4 control-label">Max Quantity</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="max_quantity"
                               value="{{ old('max_quantity', $product->max_quantity) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Min Quantity</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="min_quantity"
                               value="{{ old('min_quantity', $product->min_quantity) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Max purchase count</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="max_purchase_count"
                               value="{{ old('max_purchase_count', $product->max_purchase_count) }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-4 control-label">Hide</label>
                    <div class="col-md-6">
                        <label>
                            <input type="radio" name="hidden_from_ordering" value="1"
                                    {{  (old('hidden_from_ordering', $product->hidden_from_ordering) == '1')  ? 'checked' : '' }}
                            />
                            Yes
                        </label>
                        <label>
                            <input type="radio" name="hidden_from_ordering" value="0"
                                    {{ (old('hidden_from_ordering', $product->hidden_from_ordering) != '1')  ? 'checked' : '' }}
                            />
                            No
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">HQ Product</label>
                    <div class="col-md-6">
                        <label>
                            <input type="radio" name="is_hq" value="1"
                                    {{  (old('is_hq', $product->is_hq) != '0')  ? 'checked' : '' }}
                            />
                            Yes
                        </label>
                        <label>
                            <input type="radio" name="is_hq" value="0"
                                    {{ (old('is_hq', $product->is_hq) == '0')  ? 'checked' : '' }}
                            />
                            No
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">For Customer</label>

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
                    <label class="col-md-4 control-label">For new user</label>
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
                    <label class="col-md-4 control-label">Exipiry Date</label>
                    <div class="col-md-6">
                        <input type="text" name="expiry_date" data-plugin-datepicker
                               data-date-format="dd/mm/yyyy"
                               class="form-control"
                                value="{{ old('expiry_date', $product->expiry_date) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Role</label>
                    <div class="col-md-6">
                        <select class="form-control" name="role_id">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ (old('role', $product->role_id) == $role->id) ? 'selected' : null }}> {{ $role->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Membership product ?</label>
                    <div class="col-md-6">
                        <label>
                            <input type="radio" name="is_membership" value="1" {{  (old('is_membership', $product->is_membership) == '1')  ? 'checked' : '' }}/>
                            Yes
                        </label>
                        <label>
                            <input type="radio" name="is_membership" value="0" {{ (old('is_membership', $product->is_membership) != '1')  ? 'checked' : '' }}/>
                            No
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Membership group</label>
                    <div class="col-md-6">
                        <select class="form-control" name="membership_group_id" {{ (old('is_membership', $product->is_membership) == '1') ? null : 'disabled' }}>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}" {{ (old('membership_group_id', $product->membership_group_id) == $group->id) ? 'selected' : null }}> {{ $group->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Price *</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="price" value="{{ old('price', $product->price) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Price east *</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="price_east" value="{{ old('price_east', $product->price_east) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Delivery </label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="delivery" value="{{ old('delivery', $product->delivery) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Delivery east</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="delivery_east" value="{{ old('delivery_east', $product->delivery_east) }}" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Group</label>
                    <div class="col-md-6">
                        <select class="form-control" name="group_id">
                            <option value=''>Any</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}" {{ (old('group_id', $product->group_id) == $group->id) ? 'selected' : null }}> {{ $group->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group text-left">
                    <div class="col-md-6 col-md-offset-4">
                        *) Required
                    </div>
                </div>

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

    <product-unit product_id="{{ $product->id }}" inline-template>

        <section class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Product Units</h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary" @click="addUnit" v-if="showAddButton"><i class="fa fa-plus"></i> Add Unit</button>
                    </div>
                    @include('product-route::units.form.add-unit')
                    @include('product-route::units.form.edit-unit')

                </div>

                <br>
                <div class="row" v-if="showAddButton">
                    <div class="col-md-12">
                        <div class="table-responsive" id="product-units-container">
                            <div class="table-responsive">
                                <table class="{{isset($table_class) ? $table_class : 'table table-bordered table-striped table-condensed mb-none'}}" id="table-list-unit">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Quantity east</th>
                                        <th class="text-center">Quantity pickup</th>
                                        <th class="text-center">SKU</th>
                                        <th class="text-center" width="10%">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="! is_units">
                                            <td colspan="7" class="text-center"> No Units</td>
                                        </tr>
                                        <tr v-for="unit in units">
                                            <td>@{{ unit.name}}</td>
                                            <td>@{{ unit.description }}</td>
                                            <td>@{{ unit.pivot.quantity }}</td>
                                            <td>@{{ unit.pivot.quantity_east }}</td>
                                            <td>@{{ unit.pivot.quantity_pickup }}</td>
                                            <td>@{{ unit.sku }}</td>
                                            <td class="text-center">
                                                <form method="post" action="@{{ '/products/' + product_id + '/units/' + unit.id }}" v-on:submit.prevent="deleteUnit">
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <button class="btn btn-warning"
                                                            type="button"
                                                        @click="editUnit(unit, $enevt)">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </product-unit>
    <!-- helper -->
    <input type="hidden" name="viewUnitUrl" value="{{ url('products/' . $product->id . '/units') }}"/>

@endsection