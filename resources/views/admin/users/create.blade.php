<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users List') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="container">
                <!-- عنوان الصفحة -->
                <h2 class="mb-4 text-center text-2xl font-semibold">إضافة مستخدم جديد</h2>

                <!-- نموذج إضافة مستخدم جديد -->
                <form action="{{ route('admin.users.store') }}" method="POST" class="bg-white p-6 rounded shadow-sm">
                    @csrf

                    <!-- حقل الاسم -->
                    <div class="mb-4">
                        <label for="name" class="form-label">الاسم</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="أدخل اسم المستخدم">
                    </div>

                    <!-- حقل البريد الإلكتروني -->
                    <div class="mb-4">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="أدخل البريد الإلكتروني">
                    </div>

                    <!-- حقل كلمة السر -->
                    <div class="mb-4">
                        <label for="password" class="form-label">كلمة السر</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="password" name="password" required placeholder="أدخل كلمة السر">
                            <button type="button" class="btn btn-outline-secondary" id="copyButton">نسخ الايميل وكلمة السر</button>
                        </div>
                        <span id="copyStatus" class="text-success" style="display:none;">تم النسخ</span>
                    </div>

                    <!-- حقل حالة المستخدم -->
                    <div class="mb-4">
                        <label for="state_user" class="form-label">حالة المستخدم</label>
                        <input type="text" class="form-control" id="state_user" name="state_user" required placeholder="أدخل حالة المستخدم">
                    </div>

                    <!-- حقل الدور -->
                    <div class="mb-4">
                        <label for="role_id" class="form-label">الدور</label>
                        <select class="form-control" id="role_id" name="role_id" required>
                            <option value="3">مستخدم تجريبي</option>
                            <option value="2">مستخدم عادي</option>
                            <option value="1">مدير</option>
                        </select>
                    </div>

                    <!-- زر الإرسال -->
                    <button type="submit" class="btn btn-primary btn-block">إرسال</button>
                </form>
            </div>
        </div>
    </div>

    <script>

function generateRandomPassword(length) {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
        let password = '';
        for (let i = 0; i < length; i++) {
            password += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return password;
    }

    // توليد كلمة مرور عشوائية عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', function() {
        const passwordField = document.getElementById('password');
        const randomPassword = generateRandomPassword(12); // توليد كلمة مرور بطول 12 حرف
        passwordField.value = randomPassword; // تعيين كلمة المرور العشوائية في الحقل
    });


        // دالة لنسخ كل من البريد الإلكتروني وكلمة المرور
        function copyToClipboard() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // دمج البريد الإلكتروني وكلمة المرور مع بعضهما
            const topText = document.getElementById('name').value;
            const bottomText = "\n\n\nالنص السفلي هنا";

            // دمج النص العلوي + البريد الإلكتروني + كلمة المرور + النص السفلي
            const textToCopy = ` ${topText}\n\n\nالايميل: ${email}\n\nكلمة السر : ${password}${bottomText}`;

            // إنشاء عنصر مؤقت لنسخ النص إلى الحافظة
            const textArea = document.createElement('textarea');
            textArea.value = textToCopy;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);

            // إظهار رسالة تم النسخ
            const statusMessage = document.getElementById('copyStatus');
            statusMessage.style.display = 'inline';

            // إخفاء رسالة تم النسخ بعد 2 ثانية
            setTimeout(() => {
                statusMessage.style.display = 'none';
            }, 2000);
        }

        // إضافة حدث عند الضغط على زر النسخ
        document.getElementById('copyButton').addEventListener('click', copyToClipboard);
    </script>
</x-admin-layout>
