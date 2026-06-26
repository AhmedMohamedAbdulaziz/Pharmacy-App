<?php
namespace App\Modules\Medicine\Services;

use App\Modules\Medicine\Interfaces\MedicineRepositoryInterface;
use Illuminate\Http\Request;

class MedicineService
{
    public function __construct(protected MedicineRepositoryInterface $medicineRepo) {}

    public function all()               { return $this->medicineRepo->all(); }
    public function find(string $id)    { return $this->medicineRepo->find($id); }
    public function create(array $data) { return $this->medicineRepo->create($data); }
    public function update(string $id, array $data) { return $this->medicineRepo->update($id, $data); }
    public function delete(string $id)  { return $this->medicineRepo->delete($id); }

    public function attachImage($medicine, Request $request): void
    {
        if ($request->hasFile('image')) {
            $medicine->clearMediaCollection('medicines');
            $medicine->addMediaFromRequest('image')->toMediaCollection('medicines');
        }
    }
}
