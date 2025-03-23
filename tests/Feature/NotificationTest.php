<?php

// tests/Feature/NotificationTest.php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TestNotification;

class NotificationTest extends TestCase
{
    public function test_notification_is_sent()
    {
        // تحضير: إنشاء مستخدم تجريبي
        $user = User::factory()->create();

        // منع الإشعارات الفعلية وإجراء اختبار
        Notification::fake();

        // إرسال الإشعار
        $user->notify(new TestNotification());

        // التحقق من أن الإشعار قد تم إرساله
        Notification::assertSentTo(
            [$user], TestNotification::class
        );
    }
}
