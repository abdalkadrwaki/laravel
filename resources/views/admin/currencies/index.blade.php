<x-admin-layout>
    <style>/* تخصيص الحجم للـ badge */
        .badge-lg {
            font-size:0.8rem; /* تكبير النص */
            padding: 0.6rem 1rem; /* زيادة الحشوة الداخلية */
            border-radius: 0.3rem; /* جعل الحواف دائرية */
        }
        </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('قائمة العملات') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.currencies.create') }}" class="btn btn-primary mb-3">إضافة عملة جديدة</a>

                <div class="table-responsive shadow-lg rounded-lg bg-white p-6 m-4">
                    <table class="table table-bordered table-hover table-striped ">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th>الاسم بالعربية</th>
                                <th>الاسم بالإنجليزية</th>
                                <th>الحالة</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($currencies as $currency)
                                <tr class="text-center align-middle border-bottom">
                                    <td>{{ $currency->name_ar ?? 'غير محدد' }}</td>
                                    <td>{{ $currency->name_en ?? 'غير محدد' }}</td>

                                    <!-- استخدام span مع badge لتغيير الخلفية بحجم أكبر -->
                                    <td>
                                        @if ($currency->is_active)
                                            <span class="badge bg-success text-white badge-lg">نشط</span>
                                        @else
                                            <span class="badge bg-danger text-white badge-lg">غير نشط</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.currencies.edit', $currency->id) }}"
                                            class="btn btn-warning btn-sm">تعديل</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>



                    </table>
                </div>
            </div>
        </div>
    </div>
    @can('Administrator')
    <livewire:exchange-rates/>
    @endcan
</x-admin-layout>
