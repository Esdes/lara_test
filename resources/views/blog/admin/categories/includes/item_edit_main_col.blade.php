@php
	/** @var \App\Models|blogCategory $item */
@endphp
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="card-title"></div>
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a href="#maindata" class="nav-link active" data-toggle="tab" role="tab">Main data</a>
					</li>
				</ul>
				<br/>
				<div class="tab-content">
					<div class="tab-pane active">
						<div class="form-group">
							<label for="title">Title</label>
							<input type="text"
							value="{{ $item->title }}"
							name="title"
							id="title"
							class="form-control"
							minlength="3"
							required>
						</div>

						<div class="form-group">
							<label for="slug">Id</label>
							<input type="text"
							value="{{ $item->slug }}"
							name="slug"
							id="slug"
							class="form-control">
						</div>

						<div class="form-group">
							<label for="parent_id">Parent</label>
							<select name="parent_id"
							id="parent_id"
							class="form-control"
							placeholder="Select category"
							required>
							@foreach ($categoryList as $categoryOption)
								<option value="{{ $categoryOption->id }}"
									@if ($categoryOption->id == $item->parent_id)
										selected
									@endif>
									{{ $categoryOption->id_title }}
								</option>
							@endforeach
							</select>
						</div>

						<div class="form-group">
							<label for="description">Description</label>
							<textarea name="description"
								id="description"
								class="form-control"
								rows="3">{{ old('description', $item->description) }}
							</textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
