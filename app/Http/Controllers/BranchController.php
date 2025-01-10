<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $branches = Branch::all();
        return view('branches.index',['user' => $request->user(),'branches' => $branches]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('branches.create',['user' => $request->user()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Branch::create($validated);

        return redirect()->route('branches.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('branches.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $branch->update($validated);

        return redirect()->route('branches.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('branches.index')->with('success','Branch deleted successfully!');
    }

    public function select()
    {
        $branches = Branch::all();

        return view('branches.select', compact('branches'));
    }

    public function storeSelection($id, Request $request)
    {
        $branch = Branch::find($id);
        if (!$branch) {
            return redirect()->route('branches.select')->with('error', 'Cabang tidak ditemukan.');
        }
        $request->session()->put('selected_branch_id', $branch->id);
        return redirect()->route('dashboard')->with('success', 'Cabang berhasil dipilih!');
    }
}
