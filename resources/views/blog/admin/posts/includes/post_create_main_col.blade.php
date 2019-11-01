@php
	/** @var \App\Models|blogCategory $item */
@endphp
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="card-title"></div>
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a href="#maindata" class="nav-link active" data-toggle="tab" role="tab">Main data</a>
					</li>
					<li class="nav-item">
						<a href="#adddata" class="nav-link" data-toggle="tab" role="tab">Additional data</a>
					</li>
				</ul>
				<br/>
				<div class="tab-content">
					<div class="tab-pane active" id="maindata" role="tabpanel">
						<div class="form-group">
							<label for="title">Title</label>
							<input type="text"
							value="{{ old('title') }}"
							name="title"
							id="title"
							class="form-control"
							minlength="3"
							required>
						</div>

						<div class="form-group">
							<label for="content_raw">Article</label>
							<textarea name="content_raw"
								id="content_raw"
								class="form-control"
								rows="20">{{ old('content_raw') }}
							</textarea>
						</div>
					</div>
					<div class="tab-pane" id="adddata" role="tabpanel">

						<div class="form-group">
							<label for="category_id">Category</label>
							<select type="text"
							name="category_id"
							id="category_id"
							class="form-control"
							placeholder="Select category"
							required>
						@foreach ($categoryList as $categoryOption)
							<option value="{{ $categoryOption->id }}">
								{{ $categoryOption->id_title }}
							</option>
						@endforeach
							</select>
						</div>

						<div class="form-group">
							<label for="slug">Id</label>
							<input type="text"
							value="{{ old('slug') }}"
							name="slug"
							id="slug"
							class="form-control">
						</div>

						<div class="form-group">
							<label for="excerpt">excerpt</label>
							<textarea name="excerpt"
							id="excerpt"
							class="form-control"
							rows="3">{{ old('excerpt') }}
							</textarea>
						</div> 
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>
