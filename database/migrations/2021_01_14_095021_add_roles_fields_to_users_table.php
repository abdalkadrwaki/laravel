<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRolesFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained();
            $table->string('user_address')->nullable();
            $table->string('country_user')->nullable();
            $table->string('state_user')->nullable();
            $table->bigInteger('link_number')->nullable();
            $table->bigInteger('id_number')->nullable();
            $table->string('Office_name')->nullable();
            $table->boolean('stop_syp')->default(false);
            $table->boolean('is_active')->default(true); // حالة التفعيل أو الإيقاف

            // إضافة الفهارس لتحسين أداء عمليات البحث
            $table->index('country_user');
            $table->index('state_user');
            $table->index('link_number');
            $table->index('id_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // حذف الفهارس المُضافة
            $table->dropIndex(['country_user']);
            $table->dropIndex(['state_user']);
            $table->dropIndex(['link_number']);
            $table->dropIndex(['id_number']);

            // يمكن أيضًا إزالة الأعمدة والمفتاح الخارجي إذا رغبت بذلك
            $table->dropForeign(['role_id']);
            $table->dropColumn([
                'role_id',
                'user_address',
                'country_user',
                'state_user',
                'link_number',
                'id_number',
                'Office_name',
                'stop_syp',
                'is_active'
            ]);
        });
    }
}
