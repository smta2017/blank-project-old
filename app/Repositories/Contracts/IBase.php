<?php

namespace App\Repositories\Contracts;

/**
 * Interface IBase Created By: Ahmed Mohamed
 */
interface IBase
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function findWhere($column, $value);

    /**
     * @param $criteria
     * @param bool $isMulti
     * @return mixed
     */
    public function findMultiWhere($criteria, bool $isMulti);

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function findWhereFirst($column, $value);

    /**
     * @param int $perPage
     * @return mixed
     */
    public function paginate($perPage = 10);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
