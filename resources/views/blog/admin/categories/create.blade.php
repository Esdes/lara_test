@extends('layouts.app')

@section('content')
<form method="POST" action="{{route('admin.blog.categories.store') }}">
    @csrf {{--need for security--}}
    <div class="container">
        @if ($errors->any())
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-lable="Close">
                        <span aria-hidden="true"></span>
                    </button>
                    {{ $errors->first() }}
                </div>
            </div>
        </div>
        @endif
        @if (session('success'))
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-lable="Close">
                        <span aria-hidden="true"></span>
                    </button>
                    {{ session()->get('success') }}
                </div>
            </div>
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('blog.admin.categories.includes.item_create_main_col')
            </div>
            <div class="col-md-3">
                @include('blog.admin.categories.includes.item_create_add_col')
            </div>
        </div>
    </div>
</form>
@endsection
