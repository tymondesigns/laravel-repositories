<?php

namespace Tymon\Repositories\Test;

use Tymon\Repositories\Eloquent\AbstractRepository;

class RepositoryStub extends AbstractRepository implements Repository, Crudable, Paginable {

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

}