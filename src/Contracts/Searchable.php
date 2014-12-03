<?php

namespace Tymon\Repositories\Contracts;

interface Searchable {

    /**
     * Search by a given query
     *
     * @param  mixed  $query
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function find($query);
}
