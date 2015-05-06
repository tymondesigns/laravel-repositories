<?php

namespace Tymon\Repositories;

use Illuminate\Support\Facades\DB;
use Tymon\Repositories\Contracts\Repository as RepositoryContract;

abstract class Repository implements RepositoryContract {

    /**
     * The model instance
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The model relations
     *
     * @var array
     */
    protected $with = [];

    /**
     * Set the array of items to eager load
     *
     * @param  array  $with
     * @return self
     */
    public function load(array $with)
    {
        $this->with = $with;

        return $this;
    }

    /**
     * Make a new instance of the entity to query on
     */
    public function make()
    {
        return $this->model->with($this->with);
    }

    /**
     * Retrieve all entities
     *
     * @param  array  $columns
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all(array $columns = ['*'])
    {
        return $this->make()->get($columns);
    }

    /**
     * Find a single entity
     *
     * @param  int    $id
     * @param  array  $columns
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $columns = ['*'])
    {
        return $this->make()->find($id, $columns);
    }

    /**
     * Create a new entity
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->attempt(function() {
            return $this->model->create($data);
        });
    }

    /**
     * Update an existing entity
     *
     * @param  int    $id
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $data)
    {
        return $this->attempt(function() {
            return $this->find($id)->fill($data)->save();
        });
    }

    /**
     * Delete an existing entity
     *
     * @param  int  $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->attempt(function() {
            return $this->find($id)->delete();
        });
    }

    /**
    * Get Results by Page
    *
    * @param  int    $limit
    * @param  array  $columns
    * @return \Illuminate\Pagination\Paginator
    */
    public function getByPage($limit = 10, array $columns = ['*'])
    {
        return $this->make()->paginate($limit, $columns);
    }

    /**
     * Search for many results by key and value
     *
     * @param  string  $key
     * @param  mixed   $value
     * @param  array   $columns
     * @return Illuminate\Database\Query\Builder
     */
    public function getManyBy($key, $value, array $columns = ['*'])
    {
        return $this->make()->where($key, $value)->get($columns);
    }

    /**
     * Search a single result by key and value
     *
     * @param  string  $key
     * @param  mixed   $value
     * @param  array   $columns
     * @return Illuminate\Database\Query\Builder
     */
    public function getFirstBy($key, $value, array $columns = ['*'])
    {
        return $this->make()->where($key, $value)->first($columns);
    }

    /**
     * Search for many results where key is in array
     *
     * @param  string  $key
     * @param  array   $array
     * @param  array   $columns
     * @return Illuminate\Database\Query\Builders
     */
    public function getWhereIn($key, array $array, array $columns = ['*'])
    {
        return $this->make()->whereIn($key, $array)->get($columns);
    }

    /**
     * Get a new instance
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function instance(array $attributes = [])
    {
        return $this->model->newInstance($attributes);
    }
    
    /**
     * Attempt a DB operation - utilising a transaction
     * 
     * @param  callable  $callback
     * @return mixed 
     */
    public function attempt(callable $callback)
    {
        DB::beginTransaction();

        try {
            $value = $callback(DB::getFacadeRoot());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $value;
    }

    /**
     * Magically call the Model instance
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        if (method_exists($this->model, $method)) {
            return call_user_func_array([$this->model, $method], $parameters);
        }

        throw new \BadMethodCallException(sprintf('Method [%s] does not exist.', $method));
    }

}
