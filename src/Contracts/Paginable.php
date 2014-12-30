<?php

namespace Tymon\Repositories\Contracts;

interface Paginable {

    /**
    * Get Results by Page
    *
    * @param  int   $limit
    * @return \Illuminate\Pagination\Paginator
    */
    public function getByPage($limit = 10);
}
