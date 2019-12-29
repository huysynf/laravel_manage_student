<?php

namespace App\Repositories;

use App\Repositories\RepositoryContract;

abstract class BaseRepository implements RepositoryContract
{

    protected $model;

    protected $query;

    protected $take;

    protected $with = [];

    protected $wheres = [];

    protected $whereIns = [];

    protected $orderBys = [];

    protected $scopes = [];

    public function all()
    {
        $this->newQuery()->eagerLoad();
        $models = $this->query->get();
        $this->unsetClauses();
        return $models;
    }

    public function count()
    {
        return $this->get()->count();
    }

    public function first()
    {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();
        $model = $this->query->firstOrFail();
        $this->unsetClauses();
        return $model;
    }

    public function get()
    {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();
        $models = $this->query->get();
        $this->unsetClauses();
        return $models;
    }

    public function getById($id)
    {
        $this->unsetClauses();
        $this->newQuery()->eagerLoad();
        return $this->query->findOrFail($id);
    }

    public function getByColumn($item, $column, array $columns = ['*'])
    {
        $this->unsetClauses();
        $this->newQuery()->eagerLoad();
        return $this->query->where($column, $item)->first($columns);
    }

    public function deleteById($id)
    {
        $this->unsetClauses();
        return $this->getById($id)->delete();
    }

    public function limit($limit)
    {
        $this->take = $limit;
        return $this;
    }

    public function orderBy($column, $direction = 'asc')
    {
        $this->orderBys[] = compact('column', 'direction');
        return $this;
    }

    public function paginate($limit = 25, array $columns = ['*'], $pageName = 'page', $page = null)
    {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();
        $models = $this->query->paginate($limit, $columns, $pageName, $page);
        $this->unsetClauses();
        return $models;
    }

    public function where($column, $value, $operator = '=')
    {
        $this->wheres[] = compact('column', 'value', 'operator');
        return $this;
    }

    public function whereIn($column, $values)
    {
        $values = is_array($values) ? $values : [$values];
        $this->whereIns[] = compact('column', 'values');
        return $this;
    }

    public function with($relations)
    {
        if (is_string($relations)) {
            $relations = func_get_args();
        }
        $this->with = $relations;
        return $this;
    }

    protected function newQuery()
    {
        $this->query = $this->model->newQuery();
        return $this;
    }

    protected function eagerLoad()
    {
        foreach ($this->with as $relation) {
            $this->query->with($relation);
        }
        return $this;
    }

    protected function setClauses()
    {
        foreach ($this->wheres as $where) {
            $this->query->where($where['column'], $where['operator'], $where['value']);
        }
        foreach ($this->whereIns as $whereIn) {
            $this->query->whereIn($whereIn['column'], $whereIn['values']);
        }
        foreach ($this->orderBys as $orders) {
            $this->query->orderBy($orders['column'], $orders['direction']);
        }
        if (isset($this->take) and !is_null($this->take)) {
            $this->query->take($this->take);
        }
        return $this;
    }


    protected function setScopes()
    {
        foreach ($this->scopes as $method => $args) {
            $this->query->$method(implode(', ', $args));
        }
        return $this;
    }

    protected function unsetClauses()
    {
        $this->wheres = [];
        $this->whereIns = [];
        $this->scopes = [];
        $this->take = null;
        return $this;
    }
}
