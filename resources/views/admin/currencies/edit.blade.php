<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('تعديل العملة') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="container">
                <h2 class="mb-4 text-center text-2xl font-semibold">تعديل العملة</h2>
                <form action="{{ route('admin.currencies.update', $currency->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- حقل الاسم بالعربية -->
                    <div class="mb-3">
                        <label for="name_ar" class="form-label">الاسم بالعربية</label>
                        <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{ $currency->name_ar }}" required>
                    </div>

                    <!-- حقل الاسم بالإنجليزية -->
                    <div class="mb-3">
                        <label for="name_en" class="form-label">الاسم بالإنجليزية</label>
                        <input type="text" class="form-control" id="name_en" name="name_en" value="{{ $currency->name_en }}" required>
                    </div>

                    <!-- حقل الحالة -->
                    <div class="mb-3">
                        <label for="is_active" class="form-label">الحالة</label>
                        <select class="form-control" id="is_active" name="is_active" required>
                            <option value="1" {{ $currency->is_active == 1 ? 'selected' : '' }}>نشط</option>
                            <option value="0" {{ $currency->is_active == 0 ? 'selected' : '' }}>غير نشط</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">تحديث</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
