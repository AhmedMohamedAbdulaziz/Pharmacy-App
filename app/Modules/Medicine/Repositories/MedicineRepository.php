<?php
namespace App\Modules\Medicine\Repositories;

use App\Modules\Medicine\Interfaces\MedicineRepositoryInterface;
use App\Modules\Medicine\Models\Medicine;

class MedicineRepository implements MedicineRepositoryInterface
{
    public function all()               { return Medicine::with(['category', 'supplier'])->get(); }
    public function find(string $id)    { return Medicine::findOrFail($id); }
    public function create(array $data) { return Medicine::create($data); }

    public function update(string $id, array $data)
    {
        $model = Medicine::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete(string $id) { return Medicine::destroy($id); }
}
