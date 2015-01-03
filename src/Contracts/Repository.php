<?php

namespace Tymon\Repositories\Contracts;

interface Repository {

    /**
     * Retrieve all entities
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Search for many results by key and value
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return Illuminate\Database\Query\Builders
     */
    public function getManyBy($key, $value);

    /**
     * Search a single result by key and value
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return Illuminate\Database\Query\Builders
     */
    public function getFirstBy($key, $value);

    /**
     * Search for many results where key is in array
     *
     * @param  string  $key
     * @param  array   $array
     * @return Illuminate\Database\Query\Builders
     */
    public function getWhereIn($key, array $array);

    /**
     * Get a new instance
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function instance(array $attributes = []);
}
