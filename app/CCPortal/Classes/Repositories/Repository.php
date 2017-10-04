<?php

namespace App\CCPortal\Classes\Repositories;
use App\CCPortal\Interfaces\Repository\IRepository as IRepository;

class Repository
{
    private $repository;

    public function __construct(IRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        $this->repository->create($data);
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function find($id)
    {
        return $this->repository->getOne($id);
    }

    public function update($id, $data)
    {
        $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        $this->repository->delete($id);
    }

    public function getRepository()
    {
        return $this->repository;
    }
}