<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Budget;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('category') // ✅ ดึงข้อมูลจากตาราง `categories`
            ->orderBy('transaction_date', 'desc')
            ->get()
            ->map(function ($transaction) {
                return [
                    'id' => $transaction->id,
                    'category' => $transaction->category->name ?? 'ไม่ระบุหมวดหมู่',
                    'icon' => $transaction->category->icon ?? '❓', // ✅ ใช้ icon จาก `categories`
                    'description' => $transaction->description ?? 'ไม่มีรายละเอียด',
                    'amount' => $transaction->amount,
                    'transaction_type' => $transaction->transaction_type,
                    'date' => $transaction->transaction_date,
                    'created_at' => $transaction->created_at,
                ];
            });

        return response()->json(['transactions' => $transactions]);
    }


    /**
     * Store a newly created transaction.
     */
    public function store(Request $request)
    {
        try {
            Log::info("📥 Data received:", $request->all());

            // ✅ ตรวจสอบข้อมูลที่รับเข้ามา
            $validated = $request->validate([
                'category_id' => 'sometimes|integer',
                'category_name' => 'required|string',
                'category_icon' => 'required|string',
                'amount' => 'required|numeric',
                'transaction_type' => 'required|string',
                'description' => 'nullable|string',
                'transaction_date' => 'required|date',
            ]);

            // ✅ รับ `user_id` จาก Auth
            $userId = Auth::id();
            if (!$userId) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
            }

            // ✅ ตรวจสอบว่าหมวดหมู่มีอยู่หรือไม่
            $category = Category::where('user_id', $userId)
                ->where('name', trim($validated['category_name']))
                ->where('type', $validated['transaction_type'])
                ->first();

            if (!$category) {
                // ✅ ถ้าหมวดหมู่ไม่มี → สร้างใหม่ พร้อม `icon`
                $category = Category::create([
                    'user_id' => $userId,
                    'name' => trim($validated['category_name']),
                    'type' => $validated['transaction_type'],
                    'icon' => $validated['category_icon'],
                ]);
                Log::info("🆕 Created new category:", $category->toArray());
            } elseif (!$category->icon) {
                // ✅ ถ้าหมวดหมู่มีอยู่แล้ว แต่ไม่มี `icon` → อัปเดต `icon`
                $category->icon = $validated['category_icon'];
                $category->save();
                Log::info("🔄 Updated category icon:", $category->toArray());
            }

            // ✅ บันทึกธุรกรรมใหม่
            $transaction = Transaction::create([
                'user_id' => $userId,
                'category_id' => $category->id,
                'category_name' => $category->name,
                'category_icon' => $category->icon, // ✅ ใช้ `icon` จากหมวดหมู่
                'amount' => $validated['amount'],
                'transaction_type' => $validated['transaction_type'],
                'description' => $validated['description'],
                'transaction_date' => $validated['transaction_date'],
            ]);
            Log::info("✅ Created new transaction:", $transaction->toArray());

            // ✅ จัดการงบประมาณ (`budget`)
            $budget = Budget::where('user_id', $userId)->first();

            if ($budget) {
                // ✅ ถ้ามีงบประมาณอยู่แล้ว → อัปเดตยอดเงิน
                $budget->amount += ($validated['transaction_type'] === 'income')
                    ? abs($validated['amount'])
                    : -abs($validated['amount']);
                $budget->save();
                Log::info("🔄 Updated existing budget:", $budget->toArray());
            } else {
                // ✅ ถ้าไม่มีงบประมาณ → สร้างใหม่
                $budget = Budget::create([
                    'user_id' => $userId,
                    'category_id' => $category->id,
                    'amount' => $validated['transaction_type'] === 'income'
                        ? abs($validated['amount'])
                        : -abs($validated['amount']),
                    'start_date' => now()->startOfMonth(),
                    'end_date' => now()->endOfMonth(),
                ]);
                Log::info("🆕 Created new budget:", $budget->toArray());
            }

            return response()->json([
                'success' => true,
                'transaction' => $transaction,
                'category' => $category,
                'budget' => $budget,
            ]);

        } catch (\Exception $e) {
            Log::error("❌ Error: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
