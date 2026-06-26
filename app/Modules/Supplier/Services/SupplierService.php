<?php
namespace App\Modules\Supplier\Services;

use App\Modules\Supplier\Interfaces\SupplierRepositoryInterface;

class SupplierService
{
    public function __construct(protected SupplierRepositoryInterface $supplierRepo) {}

    public function all()               { return $this->supplierRepo->all(); }
    public function find(string $id)    { return $this->supplierRepo->find($id); }
    public function create(array $data) { return $this->supplierRepo->create($data); }
    public function update(string $id, array $data) { return $this->supplierRepo->update($id, $data); }
    public function delete(string $id)  { return $this->supplierRepo->delete($id); }
}
