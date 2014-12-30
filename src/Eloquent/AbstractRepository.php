<?php

namespace Tymon\Repositories\Eloquent;

abstract class AbstractRepository {

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

}
