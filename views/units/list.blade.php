@extends('app')

@section('page-header')
    @include('elements.page-header', ['section_title' => 'Products', 'page_title' => 'View All UNits'])
@endsection

@section('content')
    @include('elements.success-message-partial')

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">View All Units</h2>
        </header>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed mb-none" id="table-list-product-unit">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">SKU</th>
                            <th class="text-center" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td><a href="{{ url('products/units/' . $item->id) }}">{{ $item->name }}</a></td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->sku }}</td>
                                <td class="text-center">
                                    <form class="form-horizontal" method="post" action="{{ url('products/units/'. $item->id) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <button type="submit" class="btn btn-danger delete_with_confirm"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
