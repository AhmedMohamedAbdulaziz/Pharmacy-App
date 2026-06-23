<?php

namespace App\Http\Controllers;

use App\Interfaces\MedicineRepositoryInterface;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    protected MedicineRepositoryInterface $medicineRepo;

    public function __construct(MedicineRepositoryInterface $medicineRepo)
    {
        $this->medicineRepo = $medicineRepo;
    }

    public function index()
    {
        $medicines = $this->medicineRepo->all();

        return view('medicines.index', compact('medicines'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('medicines.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'expire_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $this->medicineRepo->create($data);

        return redirect()->route('medicines.index')->with('success', 'Medicine added successfully.');
    }

    public function show(string $id)
    {
        $medicine = $this->medicineRepo->find($id);

        return view('medicines.show', compact('medicine'));
    }

    public function edit(string $id)
    {
        $medicine = $this->medicineRepo->find($id);
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('medicines.edit', compact('medicine', 'categories', 'suppliers'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'expire_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $this->medicineRepo->update($id, $data);

        return redirect()->route('medicines.index')->with('success', 'Medicine updated successfully.');
    }

    public function destroy(string $id)
    {
        $this->medicineRepo->delete($id);

        return redirect()->route('medicines.index')->with('success', 'Medicine deleted successfully.');
    }
}
