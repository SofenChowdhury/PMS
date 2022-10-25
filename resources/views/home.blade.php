@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a class="btn btn-primary col-md-12" href="{{ route('products-ajax-crud.index') }}"><i class="las la-eye"></i>Product Details<i class="las la-eye"></i></a>

                    {{-- {{ __('You are logged in!') }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
