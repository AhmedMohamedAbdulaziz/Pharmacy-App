<?php
namespace App\Modules\Category\Repositories;

use App\Modules\Category\Interfaces\CategoryRepositoryInterface;
use App\Modules\Category\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()               { return Category::all(); }
    public function find(string $id)    { return Category::findOrFail($id); }
    public function create(array $data) { return Category::create($data); }

    public function update(string $id, array $data)
    {
        $model = Category::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete(string $id) { return Category::destroy($id); }
}
