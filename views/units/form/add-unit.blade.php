<div class="col-md-4" v-if="showAddForm">
    <h3>Add Unit</h3>
    <validator name="addUnitValidation">
        <form method="post" action="{{ url('products/' . $product->id . '/units') }}" novalidate v-on:submit.prevent="saveUnit">
            {{ csrf_field() }}
            <div class="form-group" v-bind:class="$addUnitValidation.product_unit_id.invalid ? 'has-error' : ''">
                <label><strong>Unit</strong></label>
                <select class="form-control" name="product_unit_id" required
                        v-validate:product_unit_id="['required']"
                        v-model="unitData.product_unit_id"
                >
                    <option value="">Select unit</option>
                    <option value="@{{ unitOption.id }}" v-for="unitOption in unitOptions">@{{ unitOption.name }}</option>
                </select>
                <p class="help-block" v-if="$addUnitValidation.product_unit_id.required">Please choose unit</p>
            </div>
            <div class="form-group" v-bind:class="$addUnitValidation.quantity.invalid ? 'has-error' : ''">
                <label class="control-label"><strong>Quantity</strong></label>
                <input type="number" min="1" name="quantity" class="form-control" required
                       value="1"
                       v-validate:quantity="['required']"
                       v-model="unitData.quantity"
                />
                <p class="help-block" v-if="$addUnitValidation.quantity.required">Quantity is required</p>
            </div>
            <div class="form-group" v-bind:class="$addUnitValidation.quantity_east.invalid ? 'has-error' : ''">
                <label class="control-label"><strong>Quantity east</strong></label>
                <input type="number" min="1" name="quantity_east" class="form-control" required
                       v-validate:quantity_east="['required']"
                       value="1"
                       v-model="unitData.quantity_east"
                />
                <p class="help-block" v-if="$addUnitValidation.quantity_east.required">Quantity east is required</p>
            </div>
            <div class="form-group" v-bind:class="$addUnitValidation.quantity_pickup.invalid ? 'has-error' : ''">
                <label class="control-label"><strong>Quantity pickup</strong></label>
                <input type="number" min="1" name="quantity_pickup" class="form-control" required
                       v-validate:quantity_pickup="['required']"
                       value="1"
                       v-model="unitData.quantity_pickup"
                />
                <p class="help-block" v-if="$addUnitValidation.quantity_pickup.required">Quantity pickup is required</p>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" v-if="$addUnitValidation.valid && !loading">Save</button>
                <button class="btn btn-primary" v-if="loading"  disabled>Saving <i class="fa fa-spinner fa-spin"></i></button>
                &nbsp;<button class="btn btn-warning" @click="cancel">Cancel</button>
            </div>
        </form>
    </validator>

</div>
