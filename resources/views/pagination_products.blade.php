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
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $products->links() !!}