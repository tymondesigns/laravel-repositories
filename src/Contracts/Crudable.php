<?php

namespace Tymon\Repositories\Contracts;

interface Crudable {

    /**
     * Find a single entity
     *
     * @param  int    $id
     * @param  array  $with
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $with = []);

    /**
     * Create a new entity
     *
     * @param  array  $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $data);

    /**
     * Update an existing entity
     *
     * @param  int    $id
     * @param  array  $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $data);

    /**
     * Delete an existing entity
     *
     * @param  int  $id
     * @return boolean
     */
    public function delete($id);
}
