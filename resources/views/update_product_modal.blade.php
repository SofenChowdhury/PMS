<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateProductModal" aria-hidden="true">
    <form action="" method="POST" id="updateProductForm">
        @csrf
        {{-- {{ method_field('PUT') }} --}}
        <input type="hidden" id="up_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateProductModal">Update Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="errMsgContainer mb-3">

                    </div>
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input class="form-control" type="text" name="up_name" id="up_name" placeholder="Product Name">
                    </div>
                    <div class="form-group mt-2">
                        <label for="sku">Product SKU</label>
                        <input class="form-control" type="text" name="up_sku" id="up_sku" placeholder="Product SKU">
                    </div>
                    <div class="form-group mt-2">
                        <label for="price">Product Price</label>
                        <input class="form-control" type="text" name="up_price" id="up_price" placeholder="Product Price">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_product">Update Product</button>
                </div>
            </div>
            </div>
    </form>
</div>