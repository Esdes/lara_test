<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogPostRepository extends CoreRepository
{
	/**
	 * @return string
	 */
	protected function getModelClass()
	{
		return Model::class;
	}

	/**
	 *get model for redacting in admin panel
	 * 
	 * @param  int $id 
	 * 
	 * @return Model
	 */
	public function getEdit($id)
	{
		$result = $this->startConditions()->find($id);

		return $result;
	}

	/**
	 * [getAllWithPaginate description]
	 * @param  int $perPage 
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getAllWithPaginate()
	{
		$page = 25;

		$columns = [
			'id',
			'title',
			'slug',
			'is_published',
			'published_at',
			'user_id',
			'category_id',
		];

		$result = $this->startConditions()
			->select($columns)
			->orderBy('id', 'DESC')
			/*->with(['category', 'user'])*/
			->with(['category' => function($query) {
					$query->select(['id', 'title']);
				},
				'user:id,name',
			])
			->paginate($page);

		return $result;
	}

	/**
	 *get trashed model for restore in admin panel
	 * 
	 * @param  int $id 
	 * 
	 * @return Model
	 */
	public function getTrashed($id)
	{
		$result = $this->startConditions()
			->onlyTrashed()
			->find($id);

		return $result;
	}
}