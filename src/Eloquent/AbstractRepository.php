<?php 

namespace Tymon\Repositories\Eloquent;

abstract class AbstractRepository {

	/**
	 * @var Illuminate\Database\Eloquent\Model
	 */
	protected $model;

	/**
	 * Make a new instance of the entity to query on
	 *
	 * @param array  $with
	 */
	public function make(array $with = [])
	{
		return $this->model->with($with);
	}

	/**
	 * Retrieve all entities
	 *
	 * @param  array  $with
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function all(array $with = [])
	{
		return $this->make($with)->get();
	}

	/**
	 * Find a single entity
	 *
	 * @param  int    $id
	 * @param  array  $with
	 * @return Illuminate\Database\Eloquent\Model
	 */
	public function find($id, array $with = [])
	{
		return $this->make($with)->find($id);
	}

	/**
	* Get Results by Page
	*
	* @param  int    $page
	* @param  int    $limit
	* @param  array  $with
	* @return \Illuminate\Pagination\Paginator
	*/
	public function getByPage($limit = 10, $with = [])
	{
		return $this->make($with)->paginate($limit);
	}

	/**
	 * Search for many results by key and value
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @param  array   $with
	 * @return Illuminate\Database\Query\Builders
	 */
	public function getManyBy($key, $value, array $with = [])
	{
		return $this->make($with)->where($key, $value)->get();
	}

	/**
	 * Search a single result by key and value
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @param  array   $with
	 * @return Illuminate\Database\Query\Builders
	 */
	public function getFirstBy($key, $value, array $with = [])
	{
		return $this->make($with)->where($key, $value)->first();
	}

	/**
	 * Search for many results where key is in array
	 *
	 * @param  string  $key
	 * @param  array   $array
	 * @param  array   $with
	 * @return Illuminate\Database\Query\Builders
	 */
	public function getWhereIn($key, array $array, array $with = [])
	{
		return $this->make($with)->whereIn($key, $array)->get();
	}

}