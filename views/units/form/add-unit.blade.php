<form class="form-horizontal" method="post" action="{{ url('products/' . $product->id . '/units') }}"
      id="formAddUnit" v-if="showAddForm">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Add Unit</h2>
        </header>
        <div class="panel-body">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-md-4">Unit</label>
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
                <label class="control-label col-md-4">Quantity</label>
                <div class="col-md-7">
                    <input type="number" min="1" name="quantity" value="1" class="form-control" required/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Quantity east</label>
                <div class="col-md-7">
                    <input type="number" min="1" name="quantity_east" value="1" class="form-control" required/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Quantity pickup</label>
                <div class="col-md-7">
                    <input type="number" min="1" name="quantity_pickup" value="1" class="form-control" required/>
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