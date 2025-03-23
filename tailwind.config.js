const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'custom-gray2': '#eff3f3', // اللون المخصص
                'bak-gray': '#162f6e',
                'bak-gray2': '#162f8e',
                'red-1': '#ef4444',
                'Lime': '#65a30d',
                'custom-gray': '#f5f5f5', // اللون الرمادي المستخدم في الخلفية
                'form-error': '#dc2626' // لون نصوص الأخطاء
            },
            spacing: {
                '18': '4.5rem' // لضبط ارتفاع الحقول إذا لزم الأمر
            },
            borderRadius: {
                'form': '0.375rem' // تكافئ rounded في التصميم
            }
        },
    },
    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'), // لإضافة ستايل أساسي لعناصر الفورم


    ],
};
