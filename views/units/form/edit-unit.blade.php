<div class="col-md-4" v-if="showEditForm">
    <h3>Edit Unit</h3>
    <form method="post" action="@{{ '/products/' + product_id + '/units/' + unitData.id }}" v-on:submit.prevent="updateUnit">
        <div class="form-group">
            <label class="control-label">Unit</label>
            <input type="text" class="form-control" disabled value="@{{ unitData.name }}"/>
        </div>
        <div class="form-group">
            <label class="control-label ">Description</label>
            <textarea class="form-control" disabled>@{{ unitData.description }}</textarea>
        </div>
        <div class="form-group">
            <label class="control-label ">Quantity</label>
            <input type="number" min="1" name="quantity" class="form-control" required
                v-model="unitData.pivot.quantity"/>
        </div>
        <div class="form-group">
            <label class="control-label ">Quantity east</label>
            <input type="number" min="1" name="quantity_east" class="form-control" required
                v-model="unitData.pivot.quantity_east"/>
        </div>
        <div class="form-group">
            <label class="control-label ">Quantity pickup</label>
            <input type="number" min="1" name="quantity_pickup" class="form-control" required
                   v-model="unitData.pivot.quantity_pickup"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" v-if="! loading">Update</button>
            <button class="btn btn-primary" v-if="loading"  disabled>Saving <i class="fa fa-spinner fa-spin"></i></button>
            &nbsp;<button class="btn btn-warning" @click="cancel">Cancel</button>
        </div>
    </form>
</div>


