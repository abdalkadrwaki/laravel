<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Currency') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="container">
                <!-- عنوان الصفحة -->
                <h2 class="mb-4 text-center text-2xl font-semibold">إضافة عملة جديدة</h2>

                <!-- نموذج إضافة عملة جديدة -->
                <form action="{{ route('admin.currencies.store') }}" method="POST" class="bg-white p-6 rounded shadow-sm">
                    @csrf

                    <!-- حقل الاسم بالعربية -->
                    <div class="mb-4">
                        <label for="name_ar" class="form-label">الاسم بالعربية</label>
                        <input type="text" class="form-control" id="name_ar" name="name_ar" required placeholder="أدخل الاسم باللغة العربية">
                    </div>

                    <!-- حقل الاسم بالإنجليزية -->
                    <div class="mb-4">
                        <label for="name_en" class="form-label">الاسم بالإنجليزية</label>
                        <input type="text" class="form-control" id="name_en" name="name_en" required placeholder="أدخل الاسم باللغة الإنجليزية">
                    </div>

                    <!-- حقل الحالة (نشط/غير نشط) -->
                    <div class="mb-4">
                        <label for="is_active" class="form-label">الحالة</label>
                        <select id="is_active" name="is_active" class="form-control" required>
                            <option value="1">نشط</option>
                            <option value="0">غير نشط</option>
                        </select>
                    </div>

                    <!-- زر الإرسال -->
                    <button type="submit" class="btn btn-primary btn-block">إرسال</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
