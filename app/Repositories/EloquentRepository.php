<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository implements RepositoryInterface
{
    /**
     * The model to execute queries on.
     *
     * @var \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     */
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The model to execute queries on
     */
    public function __construct(Model $model)
    {
        if (config('app.debug')) {
            \DB::enableQueryLog();
        }
        $this->model = $model;
    }

    /**
     * Get a new instance of the model.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getNew(array $attributes = [])
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * Make a new instance of the entity to query on
     *
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function make(array $with = [])
    {
        return $this->model->with($with);
    }

    /**
     * Retrieve all entities
     *
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(array $with = [])
    {
        $entity = $this->make($with);
        return $entity->get();
    }

    /**
     * Find a single entity
     * composite primary key array
     *  - MemberOption::scopeCompositeKey
     *
     * @param       $id
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $with = [])
    {
        $entity = $this->make($with);

        if (is_array($id)) {
            $model = $entity->compositeKey($id)->first();
        } else {
            $model = $this->model->find($id);
        }

        return $model;
    }

    public function findByField($field, $value, $columns = ['*'])
    {
        return $this->model->where($field, '=', $value)->first($columns);
    }

    /**
     * 根据条件查询单条记录
     *
     * @param array $filters
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder|Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function findWhere($filters = [], $columns = ['*'])
    {
        return $this->model->whereNested(function ($query) use ($filters) {
            foreach ($filters as $key => $value) {
                $query->where($value[0], $value[1], $value[2]);
            }
        })->first($columns);
    }

    public function paginate($perPage = 20, $columns = ['*'])
    {
        return $this->model->orderBy('updated_at', 'DESC')->paginate($perPage, $columns);
    }

    public function getPageBy($perPage = 20, array $filters = [], $columns = ['*'], $orderBy = null, $sord = null)
    {
        return $this->model->whereNested(function ($query) use ($filters) {
            foreach ($filters as $key => $value) {
                $query->where($value[0], $value[1], $value[2]);
            }
        })->orderBy('updated_at', 'DESC')->paginate($perPage, $columns);
    }

    /**
     * Search for many results by key and value
     *
     * @param string $key
     * @param mixed  $value
     * @param array  $with
     * @return \Illuminate\Database\Query\Builder
     */
    public function getBy($key, $value, array $with = [])
    {
        return $this->make($with)->where($key, '=', $value)->get();
    }

    /**
     * 获取详情
     *
     * @param       $id
     * @param array $filters
     * @param array $columns
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder|Model|null|object
     */
    public function getInfo($id, $filters = [], $columns = ['*'], array $with = [])
    {
        $pk = 'id';
        $query = $this->model->where($pk, $id);
        if (!empty($with)) {
            $query->with($with);
        }

        if (!empty($filters)) {
            $query->whereNested(function ($query) use ($filters) {
                foreach ($filters as $key => $value) {
                    $query->where($value[0], $value[1], $value[2]);
                }
            });
        }
        return $query->first($columns);
    }

    public function create(array $input)
    {
        return $this->model->create($input);
    }

    public function update($id, array $input)
    {
        return $this->model->where('id', '=', $id)->update($input);
    }

    public function updateByOtherColumn($column, $column_value, array $input)
    {
        if(is_array($column_value)){
            return $this->model->whereIn($column, $column_value)->update($input);
        }else{
            return $this->model->where($column, '=', $column_value)->update($input);
        }

    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function forceCreate(array $data)
    {
        return $this->model->forceCreate($data);
    }

    /**
     * @param array  $filters
     * @param string $orderBy
     * @return mixed
     */
    public function query(array $filters, $orderBy = 'asc')
    {
        $query = $this->model->orderBy('id', $orderBy);
        if (!empty($filters)) {
            $query->whereNested(function ($query) use ($filters) {
                foreach ($filters as $key => $value) {
                    $query->where($value[0], $value[1], $value[2]);
                }
            });
        }
        return $query;
    }

    /**
     * 统计个数
     *
     * @param array $where e.g. `['id'=>1, 'realname'=> ['like', '%a%']]`
     * @return int
     */
    public function count(array $where = [])
    {
        return $this->model->whereNested(function ($query) use ($where) {
            foreach ($where as $field => $value) {
                if (is_array($value)) {
                    list($condition, $val) = $value;
                    $query->where($field, $condition, $val);
                } else {
                    $query->where($field, '=', $value);
                }
            }
        })->count();
    }

    public function getListByWhere($filters = [], $columns = ['*'], $with = [], $pageCount = 0)
    {
        $result = $this->model
            ->with($with)
            ->whereNested(function ($query) use ($filters) {
                if (empty($query)) return;
                foreach ($filters as $filter) {
                    $query->where($filter[0], $filter[1], $filter[2]);
                }
            });
        if ($pageCount) {
            return $result->paginate($pageCount, $columns);
        }

        $result = $result->get($columns);
        return $result;
    }
}