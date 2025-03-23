
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('قائمة المستخدمين') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">إضافة مستخدم</a>
                <div class="table-responsive shadow-lg rounded-lg bg-white p-6 m-4">
                    <table class="table table-bordered table-hover table-striped ">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <td>المحافظة</td>
                                <td>الدولة</td>
                                <th>الاسم</th>
                                <th>الدور</th>
                                <th>الإجراءات</th>
                                <th>الجلسة</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="text-center align-middle border-bottom">
                                    <td>{{ $user->state_user ?? 'غير محددة' }}</td>
                                    <td>{{ $user->country_user?? 'غير محددة' }}</td>
                                    <td>{{ $user->name }}</td>

                                    <td>
                                        @if ($user->role_id == 1)
                                            <span class="badge bg-success text-white">مدير</span>
                                        @elseif($user->role_id == 2)
                                            <span class="badge bg-info text-white">مستخدم عادي</span>
                                        @else
                                            <span class="badge bg-warning text-dark">تجريبي</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="btn btn-warning btn-sm">تعديل</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.users.terminate', $user->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('هل أنت متأكد أنك تريد إنهاء جلسة المستخدم؟')">إنهاء</button>
                                        </form>
                                    </td>
                                    <td>{{ $user->id }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
