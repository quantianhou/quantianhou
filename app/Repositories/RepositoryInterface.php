<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function all(array $with = []);

    public function find($id, array $with = []);

    public function paginate($perPage = 20, $columns = ['*']);

    /**
     * @param  string $orderBy
     *        Column name to order by.
     * @param  array  $sord
     *        Sorting order
     * @param  array  $filters
     *        An array of filters, example: array(
     *        array('field'=>'column index/name 1',
     *        'op'=>'operator','data'=>'searched string column 1'),
     *        array('field'=>'column index/name 2',
     *        'op'=>'operator','data'=>'searched string column 2'))
     *        The 'field' key will contain the 'index' column property if is set, otherwise the 'name' column property.
     *        The 'op' key will contain one of the following operators: '=', '<', '>', '<=', '>=', '<>', '!=','like', 'not like', 'is in', 'is not in'.
     *        when the 'operator' is 'like' the 'data' already contains the '%' character in the appropiate position.
     *        The 'data' key will contain the string searched by the user.
     **/
    /**
     * @param int   $perPage
     * @param array $filters
     * @param array $columns
     * @param null  $orderBy
     * @param null  $sord
     * @return mixed
     */
    public function getPageBy($perPage = 20, array $filters = [], $columns = ['*'], $orderBy = null, $sord = null);

    public function getBy($key, $value, array $with = []);

    public function create(array $input);

    public function update($id, array $input);

    public function delete($id);

    public function getInfo($id, $filters = [], $columns = ['*'], array $with = []);
}
