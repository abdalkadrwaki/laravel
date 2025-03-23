<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class CurrencyController extends Controller
{
    // التأكد من صلاحيات الوصول (إدارة فقط)
    public function __construct()
    {
        $this->middleware('auth');  // التأكد من أن المستخدم مسجل دخول
    }

    // عرض جميع العملات
    public function index()
    {
        // التأكد من أن المستخدم لديه صلاحية إدارة
        if (Gate::denies('Administrator')) {
            abort(403); // إذا لم يكن لديه صلاحية، يتم إرجاع خطأ 403
        }

        // استرجاع جميع العملات من قاعدة البيانات
        $currencies = Currency::all(); // استخدام $currencies بدلاً من $users
        return view('admin.currencies.index', compact('currencies'));
    }

    // عرض نموذج إنشاء عملة جديدة
    public function create()
    {
        return view('admin.currencies.create');
    }

    // حفظ العملة الجديدة في قاعدة البيانات
    public function store(Request $request)
    {
        // التحقق من صحة المدخلات
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        // إنشاء العملة الجديدة في قاعدة البيانات
        $currency = Currency::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'is_active' => $request->is_active,
        ]);

        // اسم الأعمدة الجديدة
        $column1 = $currency->name_en . '_1';
        $column2 = $currency->name_en . '_2';

        // إضافة الأعمدة إلى جدول friend_requests إذا لم تكن موجودة
        if (!Schema::hasColumn('friend_requests', $column1)) {
            Schema::table('friend_requests', function ($table) use ($column1) {
                $table->decimal($column1, 15, 2)->default(0);
            });
        }

        if (!Schema::hasColumn('friend_requests', $column2)) {
            Schema::table('friend_requests', function ($table) use ($column2) {
                $table->decimal($column2, 15, 2)->default(0);
            });
        }

        // إعادة التوجيه إلى صفحة العملات مع رسالة نجاح
        return redirect()->route('admin.currencies.index')->with('success', 'Currency added successfully, and columns updated in friend_requests table.');
    }

    // عرض نموذج تعديل العملة
    public function edit(Currency $currency)
    {
        return view('admin.currencies.edit', compact('currency'));
    }

    // تحديث العملة في قاعدة البيانات
    public function update(Request $request, Currency $currency)
    {
        // التحقق من صحة المدخلات
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        // تحديث البيانات في قاعدة البيانات
        $currency->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'is_active' => $request->is_active,
        ]);

        // إعادة التوجيه إلى صفحة العملات مع رسالة نجاح
        return redirect()->route('admin.currencies.index')->with('success', 'Currency updated successfully.');
    }

    // حذف العملة
    public function destroy(Currency $currency)
    {
        // حذف العملة من قاعدة البيانات
        $currency->delete();

        // إعادة التوجيه إلى صفحة العملات مع رسالة نجاح
        return redirect()->route('admin.currencies.index')->with('success', 'Currency deleted successfully.');
    }
}
