<?php
namespace App\Modules\Category\Services;

use App\Modules\Category\Interfaces\CategoryRepositoryInterface;

class CategoryService
{
    public function __construct(protected CategoryRepositoryInterface $categoryRepo) {}

    public function all()                          { return $this->categoryRepo->all(); }
    public function find(string $id)               { return $this->categoryRepo->find($id); }
    public function create(array $data)            { return $this->categoryRepo->create($data); }
    public function update(string $id, array $data){ return $this->categoryRepo->update($id, $data); }
    public function delete(string $id)             { return $this->categoryRepo->delete($id); }
}
