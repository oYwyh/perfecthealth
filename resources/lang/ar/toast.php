<?php

use Illuminate\Support\Facades\Auth;

$arr = [
    'logout' => 'نراك المرة القادمة',
    'email_exists' => 'عنوان البريد الإلكتروني موجود بالفعل.',
    'code' => 'تم ارسال رمز التحقق الخاص بك!',
    'pwd_reset' => 'تم ارسال رابط اعادة زبط كلمة المرور الخاص بك!',
    'invalid_email' => 'لم نستطع العثور على هذا البريد الالكتروني!',
    'mail_send' => 'تم ارسال البريد الالكتروني بنجاح!',
    'verified' => 'تم التحقق من حسابك!',
    'acc_not_found' => 'لم نتمكن من العثور على حساب باستخدام عنوان البريد الإلكتروني هذا.',
    'invalid_email_pwd' => 'البريد الإلكتروني أو كلمة المرور خاطئة.',
    'data_changed' => 'لا يمكنك تحديث بياناتك دون تغييرها!',
    'profile_updated' => 'لقد تم تحديث ملفك الشخصي بنجاح!',
    'pwd_update' => 'لقد تم تحديث كلمة المرور الخاصة بك بنجاح.',
    'acc_delete' => 'نحن آسفون أن نراك تذهب.',
    'acc_remove' => 'تم ازالة الحساب بنجاح!',
    'acc_register' => 'تم تسجيل الحساب بنجاح!',
    'employee_delete' => 'لقد تم حذف حسابك بنجاح.',
    'article_created' => 'تم إنشاء المقال بنجاح!',
    'article_updated' => 'تم تحديث المقال بنجاح!',
    'article_deleted' => 'تم إزاله المقال بنجاح!',
    'article_verified' => 'تم التحقق من المقال بنجاح!',
    'article_disprove' => 'تم إزاله التحقق من المقال بنجاح!',
    'service_created' => 'تم إنشاء الخدمة بنجاح!',
    'service_updated' => 'تم تحديث الخدمة بنجاح!',
    'service_deleted' => 'تم إزاله الخدمه بنجاح!',
    'service_verified' => 'تم التحقق من الخدمه بنجاح!',
    'service_disprove' => 'تم إزاله التحقق من الخدمه بنجاح!',
    'insurance_created' => 'تم إنشاء التوكيل بنجاح!',
    'insurance_updated' => 'تم تحديث التوكيل بنجاح!',
    'insurance_deleted' => 'تم إزاله التوكيل بنجاح!',
    'insurance_verified' => 'تم التحقق من التوكيل بنجاح!',
    'insurance_disprove' => 'تم إزاله التحقق من التوكيل بنجاح!',
    'mail_created' => 'تم إنشاء البريد بنجاح!',
    'mail_updated' => 'تم تحديث البريد بنجاح!',
    'mail_deleted' => 'تم إزاله البريد بنجاح!',
    'review_created' => 'تم اضافة المراجعة بنجاح!',
    'review_deleted' => 'تم إزاله المراجعة بنجاح!',
    'review_verified' => 'تم التحقق من المراجعة بنجاح!',
    'review_disprove' => 'تم إزاله التحقق من المراجعة بنجاح!',
    'review_post' => 'شكرا على تقييمنا!',
    'newsletter_deleted' => 'تم إزاله العضوية بنجاح!',
    'appointment_cancled' => "تم الغاء الموعد بنجاح!",
    'investigations_add' => 'تمت إضافة الفحوصات بنجاح',
    'insurance_add' => 'تمت إضافة التوكيل بنجاح',
    'appointment_book' => 'تم حجز الموعد بنجاح!',
    'appointment_cancled' => 'تم الغاء الموعد بنجاح!',
    'newsletter' => 'شكرًا على اشتراكك، يحتوي هذا الاشتراك على محتوى وعروض حصرية!',

];
if (Auth::check()) {
    $arr['login'] = 'Welcome back,'. Auth::user()->name .'!';
} else {
    $arr['login'] = 'Logged in successfully!';
};
return $arr;

?>
