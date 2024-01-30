<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository
 *
 * @package App\Repositories
 *
 * Репозиторий работы с сущностью.
 * Может выдавать наборы данных.
 * Не может создавать/изменять сущности.
 */
abstract class CoreRepository
{
    /**
     * @var Model
     */
    protected mixed $model;

    /**
     * CoreRepositoy constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass(): mixed;

    /**
     * @return Model|\Illuminate\Foundation\Application|mixed
     */
    protected function startConditions(): mixed
    {
        return clone $this->model;
    }


}
