@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>{{ __('Dashboard') }}</strong>
                    @can('manage products')
                    <span>{{ __('Admin') }}</span>
                    @endcan
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a class="btn btn-outline-success col-md-12" href="https://github.com/SofenChowdhury/PMS"><i class="lab la-git-alt"></i>PMS Git Link<i class="lab la-git-alt"></i></a>
                    <a class="btn btn-outline-success col-md-12 mt-3" href="{{ route('products-ajax-crud.index') }}"><i class="las la-eye"></i>Product Details<i class="las la-eye"></i></a>

                    {{-- {{ __('You are logged in!') }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
