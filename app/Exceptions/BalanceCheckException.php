<?php

namespace App\Exceptions;

use Exception;

class BalanceCheckException extends Exception
{
    /**
     * بيانات إضافية توضح سبب الخطأ
     * @var array
     */
    protected $context;

    /**
     * @param string $message - رسالة الخطأ
     * @param int $statusCode - كود حالة HTTP
     * @param array $context - بيانات إضافية للتصحيح
     */
    public function __construct(
        string $message = 'فشل في التحقق من الرصيد',
        int $statusCode = 400,
        array $context = []
    ) {
        parent::__construct($message, $statusCode);
        $this->context = $context;
    }

    /**
     * الحصول على البيانات الإضافية
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * تمثيل نصي للخطأ
     */
    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n" .
               "Context: " . json_encode($this->context);
    }
}
