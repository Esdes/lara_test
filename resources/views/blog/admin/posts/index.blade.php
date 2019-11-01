@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<nav class="navbar navbar-toglable-md navbar-light bg-faded">
					<a href="{{ route('admin.blog.posts.create') }}" class="btn btn-primary">Add</a>
				</nav>
				<div class="card">
					<div class="card-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>title</th>
									<th>Author</th>
									<th>Category</th>
									<th>Data published</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($paginator as $post)
									@php
										/** @var \App\Model\BlogPost $post */
									@endphp
									<tr @if (!$post->is_published) style="background-color: #ccc;" 	@endif>
										<td>{{$post->id}}</td>
										<td>{{$post->title}}</td>
										<td>{{ $post->user->name }}</td>
										<td>
											<a href="{{route('admin.blog.posts.edit', $post->id)}}">
												{{$post->category->title}}
											</a>
										</td>
										<td>
											{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.M H:i') : ''}}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		@if ($paginator->total() > $paginator->count())
			<br/>
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							{{ $paginator->links() }}
						</div>
					</div>	
				</div>
			</div>
		@endif

	</div>
@endsection