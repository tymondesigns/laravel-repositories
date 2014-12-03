<?php

namespace Tymon\Repositories\Eloquent;

abstract class AbstractRepository {

    /**
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
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
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->make()->get();
    }

    /**
     * Find a single entity
     *
     * @param  int  $id
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        return $this->make()->find($id);
    }

    /**
    * Get Results by Page
    *
    * @param  int    $page
    * @param  int    $limit
    * @return \Illuminate\Pagination\Paginator
    */
    public function getByPage($limit = 10)
    {
        return $this->make()->paginate($limit);
    }

    /**
     * Search for many results by key and value
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return Illuminate\Database\Query\Builder
     */
    public function getManyBy($key, $value)
    {
        return $this->make()->where($key, $value)->get();
    }

    /**
     * Search a single result by key and value
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return Illuminate\Database\Query\Builder
     */
    public function getFirstBy($key, $value)
    {
        return $this->make()->where($key, $value)->first();
    }

    /**
     * Search for many results where key is in array
     *
     * @param  string  $key
     * @param  array   $array
     * @return Illuminate\Database\Query\Builders
     */
    public function getWhereIn($key, array $array)
    {
        return $this->make()->whereIn($key, $array)->get();
    }

}