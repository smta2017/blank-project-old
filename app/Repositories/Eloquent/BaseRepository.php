<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\IBase;
use App\Exceptions\ModelNotDefined;
use Illuminate\Support\Arr;

/**
 * Class BaseRepository Created By: Ahmed Mohamed
 */
abstract class BaseRepository implements IBase
{
    /**
     * @var mixed
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @throws ModelNotDefined
     * @throws mixed
     */
    public function __construct()
    {
        $this->model = $this->getModelClass();
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function findWhere($column, $value)
    {
        return $this->model->where($column, $value)->get();
    }

    /**
     * @param $criteria
     * @param bool $isMulti
     * @return mixed
     */
    public function findMultiWhere($criteria, bool $isMulti)
    {
        foreach ($criteria as $column => $value) {
            $this->model = $this->model->where($column, $value);
        }
        if ($isMulti) {
            return $this->model->paginate(10);
        }
        return $this->model->first();
    }

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function findWhereFirst($column, $value)
    {
        return $this->model->where($column, $value)->first();
    }

    /**
     * @param int $perPage
     * @return mixed
     */
    public function paginate($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $record = $this->find($id);
        return $record->delete();
    }

    /**
     * @param mixed ...$criteria
     * @return $this|mixed
     */
    public function withCriteria(...$criteria): BaseRepository
    {
        $criteria = Arr::flatten($criteria);

        foreach ($criteria as $criterion) {
            $this->model = $criterion->apply($this->model);
        }

        return $this;
    }

    /**
     * @return mixed
     * @throws ModelNotDefined
     * @throws mixed
     */
    protected function getModelClass()
    {
        if (!method_exists($this, 'model')) {
            throw new ModelNotDefined();
        }

        return app()->make($this->model());
    }
}
