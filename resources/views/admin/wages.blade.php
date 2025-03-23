<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('شرائح الاجور ') }}
        </h2>
    </x-slot>

    <div class="container mt-2 "  style="direction: rtl;">
        <!-- صف يحتوي على عمودين: الفورم والجدول -->
        <div class="row">
            <!-- العمود الأول: نموذج الإدخال -->
            <div class="col-md-6 mb-4">
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <!-- عرض رسالة النجاح -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- نموذج الإدخال -->
                    <form action="{{ route('admin.wages.store') }}" method="POST" class="card p-4 shadow-sm">
                        @csrf
                        <div class="form-group">
                            <label for="segment_name" class="font-weight-bold">اسم شريحة</label>
                            <input type="text" class="form-control" id="segment_name" name="segment_name" placeholder="أدخل اسم الشريحة" required>
                        </div>
                        <div class="form-group">
                            <label for="wage_amount" class="font-weight-bold">مبلغ الاجور</label>
                            <input type="number" step="0.01" class="form-control" id="wage_amount" name="wage_amount" placeholder="أدخل مبلغ الاجور" required>
                        </div>
                        <div class="form-group">
                            <label for="ratio" class="font-weight-bold">نسبة</label>
                            <input type="number" step="0.01" class="form-control" id="ratio" name="ratio" placeholder="أدخل النسبة" min="0" max="1000" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-2">حفظ البيانات</button>
                    </form>
                </div>
            </div>

            <!-- العمود الثاني: جدول عرض بيانات الأجور -->
            <div class="col-md-6  ">
                <div class="bg-gray-100 p-4 rounded-lg shadow-lg">
                    <table class="tebl table-auto w-full border border-gray-900  shadow-md overflow-hidden" >
                   <thead class="bg-gray-100 text-gray-700 text-center">
                            <tr>
                                <th class="py-3 px-4 border-b text-center">#</th>
                                <th class="py-3 px-4 border-b text-center">اسم شريحة</th>
                                <th class="py-3 px-4 border-b text-center">مبلغ الاجور</th>
                                <th class="py-3 px-4 border-b text-center">نسبة</th>
                                <th class="py-3 px-4 border-b text-center">تاريخ الإنشاء</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wages as $wage)
                                <tr>
                                    <td>{{ $wage->id }}</td>
                                    <td>{{ $wage->segment_name }}</td>
                                    <td>{{ $wage->wage_amount }}</td>
                                    <td>{{ $wage->ratio }}</td>
                                    <td>{{ $wage->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <!-- زر التعديل -->
                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editModal{{ $wage->id }}">تعديل</button>
                                    </td>
                                </tr>

                                <!-- مودال التعديل -->
                                <div class="modal fade" id="editModal{{ $wage->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $wage->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $wage->id }}">تعديل
                                                    بيانات الأجر</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- نموذج التعديل -->
                                                <form action="{{ route('admin.wages.update', $wage->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="segment_name">اسم شريحة</label>
                                                        <input type="text" class="form-control" id="segment_name"
                                                            name="segment_name" value="{{ $wage->segment_name }}"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="wage_amount">مبلغ الاجور</label>
                                                        <input type="number" step="0.01" class="form-control"
                                                            id="wage_amount" name="wage_amount"
                                                            value="{{ $wage->wage_amount }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ratio">نسبة</label>
                                                        <input type="number" step="0.01" class="form-control"
                                                            id="ratio" name="ratio" value="{{ $wage->ratio }}"
                                                            min="0" max="1000" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">تحديث
                                                        البيانات</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- تضمين jQuery و Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</x-admin-layout>
