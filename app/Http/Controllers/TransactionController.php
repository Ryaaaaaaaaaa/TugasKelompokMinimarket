<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Branch;
use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User */
        $user = Auth::user();
        $branchId = '';

        if ($user->hasRole('owner')) {
            $selectedBranch = Branch::find(session('selected_branch_id'));
            $branchId = $selectedBranch->id ?? 'Cabang Tidak Ditemukan';
        } else {
            $branchId = $user->branch->id ?? 'Cabang Tidak Ditemukan';
        }
        $branchId = $branchId;

        $transactions = Transaction::with(['user'])->where('branch_id', $branchId)->get();
        return view('transactions.index',['user' => $request->user(),'transactions'=>$transactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $users = User::all();
        return view('transactions.create', compact('products','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /** @var \App\Models\User */
        $user = Auth::user();
        $branchId = '';

        if ($user->hasRole('owner')) {
            $selectedBranch = Branch::find(session('selected_branch_id'));
            $branchId = $selectedBranch->id ?? 'Cabang Tidak Ditemukan';
        } else {
            $branchId = $user->branch->id ?? 'Cabang Tidak Ditemukan';
        }
        $branchId = $branchId;
        $request->validate([
            'total_price' => 'required|numeric|min:0',
            'cart' => 'required|array',
            'cart.*.productId' => 'required|exists:products,id',
            'cart.*.qty' => 'required|integer|min:1',
            'cart.*.price' => 'required|numeric|min:0',
        ]);

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'branch_id' => $branchId,
            'total_price' => $request->total_price,
            'date' => $request->date,
        ]);

        foreach ($request->cart as $item) {
            DetailTransaction::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item['productId'],
                'qty' => $item['qty'],
                'unit_price' => $item['price'],
            ]);
        }

        return response()->json(['success' => true]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $transaction->load('transactionDetails');
        return view('transactions.detail', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $transactionDetails = $transaction->transactionDetails;
        $products = Product::all();
        $cart = $transactionDetails->map(function ($detail) {
            return [
                'productId' => $detail->product_id,
                'name' => $detail->product->name,
                'price' => $detail->product->price,
                'qty' => $detail->qty,
                'stock' => $detail->product->stock,
            ];
        });

        return view('transactions.edit', compact('transaction', 'transactionDetails', 'products', 'cart'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'total_price' => 'required|numeric|min:0',
            'date' => 'required|date',
            'cart' => 'required|array|min:1',
            'cart.*.productId' => 'required|exists:products,id',
            'cart.*.qty' => 'required|integer|min:1',
            'cart.*.price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($validated, $transaction) {
            $transaction->transactionDetails()->delete();
            /** @var \App\Models\User */
            $user = Auth::user();
            $branchId = '';

            if ($user->hasRole('owner')) {
                $selectedBranch = Branch::find(session('selected_branch_id'));
                $branchId = $selectedBranch->id ?? 'Cabang Tidak Ditemukan';
            } else {
                $branchId = $user->branch->id ?? 'Cabang Tidak Ditemukan';
            }
            $branchId = $branchId;
            $transaction->update([
                'user_id' => $user->id,
                'branch_id' => $branchId,
                'total_price' => $validated['total_price'],
                'date' => $validated['date'],
            ]);
            foreach ($validated['cart'] as $item) {
                $transaction->transactionDetails()->create([
                    'product_id' => $item['productId'],
                    'qty' => $item['qty'],
                    'unit_price' => $item['price'],
                ]);
            }
        });

        return redirect()->route('transactions.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        DetailTransaction::where('transaction_id', $transaction->id)->delete();
        $transaction->delete();

        return redirect()->route('transactions.index');
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', "%$query%")->get();
        return response()->json($products);
    }


}
