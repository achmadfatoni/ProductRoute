@extends('app')

@section('page-header')
    @include('elements.page-header', ['section_title' => 'Products Unit', 'page_title' => 'Edit Product Unit'])
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Edit Product Unit</h2>
        </div>
        <div class="panel-body">
            <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST"
                  action="{{ url('/products/units/' . $productUnit->id) }}">
                {{ csrf_field() }}
                <input type="hidden" value="PUT" name="_method"/>

                <div class="form-group">
                    <label class="col-md-3 control-label">Unit Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" value="{{ old('name', $productUnit->name) }}">
                        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Unit Description</label>
                    <div class="col-md-6">
                        <textarea rows="10" class="form-control" name="description">{{ old('description', $productUnit->description) }}</textarea>
                        @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                    </div>
                </div>

                <div class="form-group @if ($errors->has('sku')) has-error @endif">
                    <label class="col-md-3 control-label">SKU *) </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="sku" value="{{ old('sku', $productUnit->sku) }}" required>
                        @if ($errors->has('sku')) <p class="help-block">{{ $errors->first('sku') }}</p> @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-la col-md-push-3 col-md-6">*) Required</label>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection