<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- منع ترجمة الصفحة عبر المتصفح
    <meta name="google" content="notranslate">
-->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"> <!-- نستخدم mix فقط -->

    @livewireStyles
</head>
<style>
    /* منع ترجمة الصفحة */
    html {
        translate: no !important;
    }

    /* منع تحديد النصوص (نسخها)
    body {
        user-select: none;
    }

    /* تحديد ارتفاع عنصر Select2 */
    .select2-container--default .select2-selection--single .select2-selection__clear {
        display: none;
    }

    .select2-container .select2-selection--single {
        height: 38px !important;
        /* يمكنك تغيير القيمة حسب الحاجة */
        direction: rtl;
        text-align: right;
        /* محاذاة النص إلى اليمين */
    }

    .select2-container--default .select2-results__option {
        direction: rtl;
        text-align: right;
    }

    /* تحديد ارتفاع العنصر الداخلي */
    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 38px !important;
        /* يجب أن يكون مساويًا للارتفاع */
    }

    /* تحديد ارتفاع السهم */
    .select2-container .select2-selection--single .select2-selection__arrow {
        height: 38px !important;
        left: 10px;
        /* تحريك السهم إلى اليسار */
        right: auto;
        /* إلغاء الموضع الافتراضي */
    }
</style>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-custom-gray2">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        <header>
            @isset($header)
                <div class="bg-white shadow">
                    <div>
                        {{ $header }}
                    </div>
                </div>
            @endisset
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>



    </div>

    @stack('modals')

    @livewireScripts

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>





</body>

</html>
