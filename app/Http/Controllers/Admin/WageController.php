<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wage_type;

class WageController extends Controller
{
    // عرض صفحة الإدخال والجدول
    public function index()
    {
        $wages = Wage_type::all();
        return view('admin.wages', compact('wages'));
    }

    // تخزين بيانات الاجور
    public function store(Request $request)
    {
        $request->validate([
            'segment_name' => 'required|string|max:255',
            'wage_amount'  => 'required|numeric',
            'ratio'        => 'required|numeric|min:0|max:1000',
        ]);

        Wage_type::create([
            'segment_name' => $request->segment_name,
            'wage_amount'  => $request->wage_amount,
            'ratio'        => $request->ratio,
        ]);

        return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح');
    }

    // تحديث بيانات الاجور
    public function update(Request $request, $id)
    {
        $request->validate([
            'segment_name' => 'required|string|max:255',
            'wage_amount'  => 'required|numeric',
            'ratio'        => 'required|numeric|min:0|max:1000',
        ]);

        $wage = Wage_type::find($id);
        $wage->update([
            'segment_name' => $request->segment_name,
            'wage_amount'  => $request->wage_amount,
            'ratio'        => $request->ratio,
        ]);

        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح');
    }
}
