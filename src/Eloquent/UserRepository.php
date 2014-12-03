<?php

namespace Tymon\Repositories\Eloquent;

use Tymon\Repositories\Contracts\Repository;
use Tymon\Repositories\Contracts\Crudable;
use Tymon\Repositories\Contracts\Paginable;
use Tymon\Repositories\Contracts\Searchable;
use User;

class UserRepository extends AbstractRepository implements Repository, Crudable, Paginable, Searchable
{
	public function __construct(User $model)
	{
		$this->model = $model;
	}
}