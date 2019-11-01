<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogCategoryRepository extends CoreRepository
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
		return $this->startConditions()->find($id);
	}

	/**
	 *get list categories for show in drop down list
	 * 
	 * @return Collection
	 */
	public function getForCombobox()
	{
		$columns = implode(",", [
			'id',
			'CONCAT(id,". ", title) AS id_title'
		]);

		$result = $this->startConditions()
			->selectRaw($columns)
			->toBase()
			->get();

		return $result;
	}

	/**
	 * [getAllWithPaginate description]
	 * @param  int $perPage 
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getAllWithPaginate($perPage = 10)
	{
		$columns = [
			'id',
			'title',
			'parent_id'
		];

		$result = $this->startConditions()
			->select($columns)
			->with(['parentCategory:id,title'])
			->paginate($perPage);

		return $result;
	}
}