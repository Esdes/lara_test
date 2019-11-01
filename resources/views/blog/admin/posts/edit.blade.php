@extends('layouts.app')
@section('content')
@php /** @var \App\Models\BlogPost $item*/ @endphp
<div class="container">
    @include('blog.admin.posts.includes.result_messages')
    <form method="POST" action="{{route('admin.blog.posts.update', $item->id) }}">
        @method('PATCH') {{--need for laravel--}}
        @csrf {{--need for security--}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('blog.admin.posts.includes.post_edit_main_col')
            </div>
            <div class="col-md-3">
                @include('blog.admin.posts.includes.post_edit_add_col')
            </div>
        </div>
    </form>

    <br/>
    <form method="POST" action="{{route('admin.blog.posts.destroy', $item->id) }}">
        @method('DELETE') {{--need for laravel--}}
        @csrf {{--need for security--}}
        <div class="row justify-content-center">
        	<div class="col-md-8">
           		<div class="card card-block">
           			<div class="card-body ml-auto">
           				<button type="submit" class="btn btn-link">Delete</button>
           			</div>
        		</div>
        	</div>
            <div class="col-md-3"></div>
        </div>
    </form>
</div>
@endsection
