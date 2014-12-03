<?php

namespace Tymon\Repositories\Contracts;

interface Paginable {

    /**
    * Get Results by Page
    *
    * @param  int   $page
    * @param  int   $limit
    * @param  array $with
    * @return \Illuminate\Pagination\Paginator
    */
    public function getByPage($limit = 10, $with = []);
}