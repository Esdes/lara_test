@extends('layouts.app')

@section('content')
<form method="POST" action="{{route('admin.blog.posts.store') }}">
    @csrf {{--need for security--}}
    <div class="container">
        @include('blog.admin.posts.includes.result_messages')
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('blog.admin.posts.includes.post_create_main_col')
            </div>
            <div class="col-md-3">
                @include('blog.admin.posts.includes.post_create_add_col')
            </div>
        </div>
    </div>
</form>
@endsection
