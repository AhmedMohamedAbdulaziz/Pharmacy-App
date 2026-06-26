<?php
namespace App\Modules\Supplier\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Supplier\Requests\StoreSupplierRequest;
use App\Modules\Supplier\Requests\UpdateSupplierRequest;
use App\Modules\Supplier\Services\SupplierService;

class SupplierController extends Controller
{
    public function __construct(protected SupplierService $supplierService) {}

    public function index()
    {
        $suppliers = $this->supplierService->all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create() { return view('suppliers.create'); }

    public function store(StoreSupplierRequest $request)
    {
        $this->supplierService->create($request->validated());
        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully.');
    }

    public function show(string $id)
    {
        $supplier = $this->supplierService->find($id);
        return view('suppliers.show', compact('supplier'));
    }

    public function edit(string $id)
    {
        $supplier = $this->supplierService->find($id);
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request, string $id)
    {
        $this->supplierService->update($id, $request->validated());
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy(string $id)
    {
        $this->supplierService->delete($id);
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
