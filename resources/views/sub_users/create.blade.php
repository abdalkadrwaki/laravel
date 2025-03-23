<x-teacher-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            الحوالات الواردة
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-blue-600 text-white">
                <h1 class="text-2xl font-bold">إنشاء مستخدم فرعي</h1>
            </div>
            <div class="card-body">
                <!-- عرض أخطاء التحقق إن وجدت -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- نموذج إنشاء المستخدم الفرعي -->
                <form action="{{ url('/sub-users') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">الاسم:</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="أدخل الاسم" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">البريد الإلكتروني:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="أدخل البريد الإلكتروني" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور:</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="أدخل كلمة المرور" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">تأكيد كلمة المرور:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="أعد إدخال كلمة المرور" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        إنشاء المستخدم الفرعي
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-teacher-layout>
