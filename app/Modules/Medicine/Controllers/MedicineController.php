<?php
namespace App\Modules\Medicine\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Medicine\Requests\StoreMedicineRequest;
use App\Modules\Medicine\Requests\UpdateMedicineRequest;
use App\Modules\Medicine\Services\MedicineService;
use App\Modules\Category\Models\Category;
use App\Modules\Supplier\Models\Supplier;

class MedicineController extends Controller
{
    public function __construct(protected MedicineService $medicineService) {}

    public function index()
    {
        $medicines = $this->medicineService->all();
        return view('medicines.index', compact('medicines'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $suppliers  = Supplier::orderBy('name')->get();
        return view('medicines.create', compact('categories', 'suppliers'));
    }

    public function store(StoreMedicineRequest $request)
    {
        $medicine = $this->medicineService->create($request->safe()->except('image'));
        $this->medicineService->attachImage($medicine, $request);
        return redirect()->route('medicines.index')->with('success', 'Medicine added successfully.');
    }

    public function show(string $id)
    {
        $medicine = $this->medicineService->find($id);
        return view('medicines.show', compact('medicine'));
    }

    public function edit(string $id)
    {
        $medicine   = $this->medicineService->find($id);
        $categories = Category::orderBy('name')->get();
        $suppliers  = Supplier::orderBy('name')->get();
        return view('medicines.edit', compact('medicine', 'categories', 'suppliers'));
    }

    public function update(UpdateMedicineRequest $request, string $id)
    {
        $medicine = $this->medicineService->update($id, $request->safe()->except('image'));
        $this->medicineService->attachImage($medicine, $request);
        return redirect()->route('medicines.index')->with('success', 'Medicine updated successfully.');
    }

    public function destroy(string $id)
    {
        $this->medicineService->delete($id);
        return redirect()->route('medicines.index')->with('success', 'Medicine deleted successfully.');
    }
}
