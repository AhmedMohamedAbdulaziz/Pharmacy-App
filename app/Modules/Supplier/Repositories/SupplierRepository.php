<?php
namespace App\Modules\Supplier\Repositories;

use App\Modules\Supplier\Interfaces\SupplierRepositoryInterface;
use App\Modules\Supplier\Models\Supplier;

class SupplierRepository implements SupplierRepositoryInterface
{
    public function all()               { return Supplier::all(); }
    public function find(string $id)    { return Supplier::findOrFail($id); }
    public function create(array $data) { return Supplier::create($data); }

    public function update(string $id, array $data)
    {
        $model = Supplier::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete(string $id) { return Supplier::destroy($id); }
}
