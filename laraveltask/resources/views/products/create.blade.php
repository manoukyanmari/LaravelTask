@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Products / Create </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('products.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('product_name')) has-error @endif">
                    <label for="product_name-field">Product Name</label>
                    <input type="text" id="product_name-field" name="product_name" class="form-control" value="{{ old("product_name") }}"/>
                    </div>

                <div class="form-group">
                    <label for="path-field">Quantity</label>
                    <input type="text" id="quantity-field" name="quantity" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="path-field">Price</label>
                    <input type="text" id="price-field" name="price" class="form-control"/>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('products.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection