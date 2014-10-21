<?php 

namespace Tymon\Repositories\Contracts;

interface Repository {

	/**
	 * Retrieve all entities
	 *
	 * @param  array  $with
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function all(array $with = []);

	/**
	 * Search for many results by key and value
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @param  array   $with
	 * @return Illuminate\Database\Query\Builders
	 */
	public function getManyBy($key, $value, array $with = []);

	/**
	 * Search a single result by key and value
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @param  array   $with
	 * @return Illuminate\Database\Query\Builders
	 */
	public function getFirstBy($key, $value, array $with = []);

	/**
	 * Search for many results where key is in array
	 *
	 * @param  string  $key
	 * @param  array   $array
	 * @param  array   $with
	 * @return Illuminate\Database\Query\Builders
	 */
	public function getWhereIn($key, array $array, array $with = []);

}
