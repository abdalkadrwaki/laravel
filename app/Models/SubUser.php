<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'email', 'password' ,'role_id', 'parent_id' ];

    // تشفير كلمة المرور عند الإنشاء
    protected static function booted()
    {
        static::creating(function ($subUser) {
            $subUser->password = bcrypt($subUser->password);
        });
    }

    // علاقة المستخدم الفرعي بالمستخدم الأصلي
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
