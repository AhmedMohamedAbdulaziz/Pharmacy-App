<?php

namespace App\Repositories;

use App\Interfaces\MedicineRepositoryInterface;
use App\Models\Medicine;

class MedicineRepository implements MedicineRepositoryInterface
{
    public function all()
    {
        return Medicine::with(['category', 'supplier'])->get();
    }

    public function find(string $id)
    {
        return Medicine::findOrFail($id);
    }

    public function create(array $data)
    {
        return Medicine::create($data);
    }

    public function update(string $id, array $data)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->update($data);
        return $medicine;
    }

    public function delete(string $id)
    {
        return Medicine::destroy($id);
    }
}
