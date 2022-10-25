@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="my-5 text-center">Products Ajax CRUD</h2>
            @can('manage products')
            <a class="btn btn-success my-3" href="#" data-bs-toggle="modal" data-bs-target="#addModal"><i class="las la-plus"></i>Add Product</a>
            @endcan
            <input type="text" name="search" id="search" class="mb-3 form-control" placeholder="Search here...">
            <div class="table-bordered">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Name</td>
                            <td>SKU</td>
                            {{-- <td>Category</td> --}}
                            <td>Price</td>
                            {{-- <td>Status</td> --}}
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key=>$product)
                        <tr class="table-active">
                            <td>{{$key+1}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->sku}}</td>
                            {{-- <td>{{$products->category_id}}</td> --}}
                            <td>{{$product->price}}</td>
                            {{-- <td>{{$product->status}}</td> --}}
                            <td>
                                @can('manage products')
                                <a  href="#"
                                    class="btn btn-primary update_product_form" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#updateModal" 
                                    data-id="{{ $product->id }}" 
                                    data-name="{{ $product->name }}" 
                                    data-sku="{{ $product->sku }}" 
                                    data-price="{{ $product->price }}" 
                                ><i class="las la-edit"></i>
                                </a>
                                <a  href="#"
                                    class="btn btn-danger delete_product" 
                                    data-id="{{ $product->id }}"
                                ><i class="las la-times"></i>
                                </a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $products->links() !!}
            </div>
        </div>
    </div>
</div>
@include('add_product_modal')
@include('update_product_modal')
@include('product_js')
@endsection