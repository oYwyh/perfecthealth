<?php

use Illuminate\Support\Facades\Auth;

$arr = [
    'logout' => 'See you next time!',
    'email_exist' => 'Email address already exists.',
    'code' => 'Verfication code sent!',
    'invalid_email' => 'We couldn\t find the email address!',
    'mail_send' => 'Mail has been sent successfully!',
    'pwd_reset' => 'Passowrd reset link has been sent!',
    'verified' => 'Your account has been verified!',
    'pwd_update' => 'Your password has been updated successfully.',
    'acc_not_found' => 'We couldn\'t find an account with that email address.',
    'invalid_email_pwd' => 'Invalid Email or password.',
    'data_changed' => 'You can\'t update your data without changing it!',
    'data_change_success' => 'Date changed successfully!',
    'profile_updated' => 'You profile has been updated successfully!',
    'acc_delete' => 'We\'re sorry to see you go.',
    'acc_register' => 'Account has been registered successfully!',
    'acc_remove' => 'Account has been removed successfully!',
    'employee_delete' => 'Your account has been deleted successfully.',
    'article_created' => 'Article has been created successfully!',
    'article_updated' => 'Article has been updated successfully!',
    'article_verified' => 'Article has been verified successfully!',
    'article_disprove' => 'Article has been disproved successfully!',
    'article_deleted' => 'Article has been deleted successfully!',
    'service_created' => 'Service has been created successfully!',
    'service_updated' => 'Service has been updated successfully!',
    'service_verified' => 'Service has been verified successfully!',
    'service_disprove' => 'Services has been disproved successfully!',
    'service_deleted' => 'Service has been deleted successfully!',
    'insurance_updated' => 'Insurance has been updated successfully!',
    'insurance_created' => 'Insurance has been created successfully!',
    'insurance_verified' => 'Insurance has been verified successfully!',
    'insurance_deleted' => 'Insurance has been deleted successfully!',
    'insurance_disprove' => 'Insurance has been disproved successfully!',
    'mail_created' => 'Mail has been created successfully!',
    'mail_updated' => 'Mail has been updated successfully!',
    'mail_deleted' => 'Mail has been deleted successfully!',
    'review_created' => 'Review has been created successfully!',
    'review_deleted' => 'Review has been removed successfully!',
    'review_verified' => 'Review has been verified successfully!',
    'review_deleted' => 'Review has been deleted successfully!',
    'review_disprove' => 'Review has been disproved successfully!',
    'review_post' => 'Thanks for your review!',
    'newsletter_deleted' => 'Member has been removed from newsletter successfully!',
    'investigations_add' => 'Investigations has been added successfully!',
    'insurance_add' => 'Insurance has been added successfully!',
    'appointment_created' => "Appointment has been created successfully!",
    'appointment_book' => 'Appointment has been booked successfully!',
    'appointment_cancled' => 'Appointment has been cancled successfully!',
    'newsletter' => 'Thanks for your subscription,This subscription contains exclusive content and offers!'


];
if (Auth::check()) {
    $arr['login'] = 'Welcome back,'. Auth::user()->name .'!';
} else {
    $arr['login'] = 'Logged in successfully!';
};
return $arr;


?>
