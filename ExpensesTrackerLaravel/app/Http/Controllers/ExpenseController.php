<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('auth')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        $expenses = Auth::user()->expenses()
                        ->orderBy('date', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        $totalExpenses = $expenses->sum('amount');
        
        return view('dashboard', compact('expenses', 'totalExpenses'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'date' => 'required|date',
        ]);

        $expense = Expense::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'category' => $request->category,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        // Check if this is an AJAX request
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pengeluaran berhasil ditambahkan!',
                'expense' => $expense
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Pengeluaran berhasil ditambahkan!');
    }
    
    public function update(Request $request, Expense $expense)
    {
        // Check if the expense belongs to the authenticated user
        if ($expense->user_id !== Auth::id()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }
            abort(403);
        }
        
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'date' => 'required|date',
        ]);

        $expense->update([
            'amount' => $request->amount,
            'category' => $request->category,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        // Check if this is an AJAX request
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pengeluaran berhasil diupdate!',
                'expense' => $expense->fresh()
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Pengeluaran berhasil diupdate!');
    }
    
    public function destroy(Request $request, Expense $expense)
    {
        // Check if the expense belongs to the authenticated user
        if ($expense->user_id !== Auth::id()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }
            abort(403);
        }

        $expense->delete();

        // Check if this is an AJAX request
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pengeluaran berhasil dihapus!'
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Pengeluaran berhasil dihapus!');
    }
}