<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        // Mengambil semua data stores
        $stores = Store::all();
        return view('stores.index', compact('stores'));
    }
}
