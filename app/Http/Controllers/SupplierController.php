<?php

namespace App\Http\Controllers;

use App\Interfaces\SupplierRepositoryInterface;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected SupplierRepositoryInterface $supplierRepo;

    public function __construct(SupplierRepositoryInterface $supplierRepo)
    {
        $this->supplierRepo = $supplierRepo;
    }

    public function index()
    {
        $suppliers = $this->supplierRepo->all();

        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
        ]);

        $this->supplierRepo->create($data);

        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully.');
    }

    public function show(string $id)
    {
        $supplier = $this->supplierRepo->find($id);

        return view('suppliers.show', compact('supplier'));
    }

    public function edit(string $id)
    {
        $supplier = $this->supplierRepo->find($id);

        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
        ]);

        $this->supplierRepo->update($id, $data);

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy(string $id)
    {
        $this->supplierRepo->delete($id);

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
