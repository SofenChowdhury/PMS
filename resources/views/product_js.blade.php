<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function(){
        // alert();
        //add product
        $(document).on('click','.add_product',function(e){
            e.preventDefault();
            let name = $('#name').val();
            let sku = $('#sku').val();
            let price = $('#price').val();
            // console.log(name+sku+price);
            $.ajax({
                url:"{{ route('products-ajax-crud.store') }}",
                method:'POST',
                data:{name:name,sku:sku,price:price},
                success:function(res){
                    if(res.status=='success'){
                        $('#addModal').modal('hide');
                        $('#addProductForm')[0].reset();
                        $('.table').load(location.href+' .table');
                    }
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value){
                        $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>');
                    });
                }
            });
        });
        //show product value 
        $(document).on('click','.update_product_form',function(e){
            let id = $(this).data('id');
            let name = $(this).data('name');
            let sku = $(this).data('sku');
            let price = $(this).data('price');
            $('#up_id').val(id);
            $('#up_name').val(name);
            $('#up_sku').val(sku);
            $('#up_price').val(price);
        });
        //update product
        $(document).on('click','.update_product',function(e){
            e.preventDefault();
            let up_id = $('#up_id').val();
            let up_name = $('#up_name').val();
            let up_sku = $('#up_sku').val();
            let up_price = $('#up_price').val();
            // console.log(up_id+up_name+up_sku+up_price);
            $.ajax({
                url:"{{ route('products-ajax-crud-update') }}",
                method:'POST',
                data:{up_id:up_id,up_name:up_name,up_sku:up_sku,up_price:up_price},
                success:function(res){
                    // console.log(res.data);
                    if(res.status=='success'){
                        $('#updateModal').modal('hide');
                        $('#updateProductForm')[0].reset();
                        $('.table').load(location.href+' .table');
                    }
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value){
                        $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>');
                    });
                }
            });
        });
        //delete product
        $(document).on('click','.delete_product',function(e){
            e.preventDefault();
            let product_id = $(this).data('id');
            if(confirm('Are you sure to delete product?')){
                $.ajax({
                    url:"{{ route('products-ajax-crud-delete') }}",
                    method:'DELETE',
                    data:{product_id:product_id},
                    success:function(res){
                        // console.log(res.data);
                        if(res.status=='success'){
                            $('.table').load(location.href+' .table');
                        }
                    }
                });
            }
            
        });
        //paginate
        $(document).on('click','.pagination a',function(e){
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            product(page)
        });
        function product(page){
            $.ajax({
                url:"/pagination/paginate-data?page="+page,
                success:function(res){
                    $('.table-bordered').html(res);
                }
            });
        }
        //search 
        $(document).on('keyup',function(e){
            e.preventDefault();
            let search_string = $('#search').val();
            console.log(search_string);
            $.ajax({
                url:"{{ route('serach.product') }}",
                method:'GET',
                data:{search_string:search_string},
                success:function(res){
                    $('.table-bordered').html(res);
                    if(res.status=='nothing_found'){
                        $('.table-bordered').html('<span class="text-danger">'+'Nothing Found'+'</span>');
                    }
                }
            });
        });
    });
</script>