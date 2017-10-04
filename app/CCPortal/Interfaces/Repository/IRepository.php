<?php

namespace App\CCPortal\Interfaces\Repository;

interface IRepository
{
    /**
     * @return void
     * @param $data is the values to be saved and it's an array
     */
    public function create(array $data);

    /**
     * @return eloquent collection
     *
     */
    public function getAll();
    /**
     * @return model
     * @param $id is an string
     */
    public function getOne($id);
    /**
     * @return void
     * @param $id is an string
     */
    public function update($id, array $data);
    /**
     * @return void
     * @param $id is an string
     */
    public function delete($id);
}