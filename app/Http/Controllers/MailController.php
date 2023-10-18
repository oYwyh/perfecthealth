<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\MailPwd;
use App\Models\Admin;
use App\Models\Doctor;
use App\Mail\MailNotify;
use App\Mail\MailVerify;
use Mockery\Expectation;
use App\Models\Newsletter;
use Illuminate\Support\Str;
use App\Models\Receptionist;
use GuzzleHttp\Psr7\Request;
use App\Tables\Receptionists;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;

class MailController extends Controller
{
    public function verify() {
        $data = [
            'subject' => 'Email Verfication Code',
            'code' => Auth::user()->verification_code,
        ];
        try {
            Mail::to(Auth::user()->email)->send(new MailVerify($data));
            Toast::info(Lang::get('toast.code'));
            return redirect()->route('home');
        } catch (Expectation $th) {
            return response()->json('not nice');
        }
    }
    public function reset_pwd() {
        $user = User::where('email', '=', Session::get('email'))->first();
        if($user) {
            $token = Str::random(60); // generate a unique token
            $user->reset_token = $token; // store the token in the user's record
            $user->save();

            $data = [
                'subject' => 'Restore Your Password',
                'body' => 'Click on that link to restore ur password',
                'token' => $token,
            ];
            // rest of the code
            try {
                Mail::to(Session::get('email'))->send(new MailPwd($data));
                Session::put('reset_token', uniqid());
                Toast::info(Lang::get('toast.pwd_reset'));
                return redirect()->route('home', ['reset_token' => Session::get('reset_token')]);
            } catch (Expectation $th) {
                return response()->json('not nice');
            }
        }else {
            Toast::danger(Lang::get('toast.invalid_email'));
            return redirect()->route('home');
        }
        // rest of the code
    }

    public function mail_send() {
        $mail_id = Session::get('mail_id');
        // if(Session::get('mail_img_path')) {
        //     $mail_img_path = Session::get('mail_img_path');
        // }
        $mail = \App\Models\Mail::find($mail_id);
        $reciver_type = $mail->recivers;
        switch ($reciver_type) {
            case 'admins':
                $admin = Admin::all();
                $recivers = [];
                foreach ($admin as $admin) {
                    $recivers[] = $admin->email;
                }
            break;
            case 'doctors':
                $doctors = Doctor::all();
                $recivers = [];
                foreach ($doctors as $doctor) {
                    $recivers[] = $doctor->email;
                }
            break;
            case 'users':
                $user = User::all();
                $recivers = [];
                foreach ($user as $user) {
                    $recivers[] = $user->email;
                }
            break;
            case 'receptionists':
                $receptionists = Receptionist::all();
                $recivers = [];
                foreach ($receptionists as $receptionists) {
                    $recivers[] = $receptionists->email;
                }
            break;
            case 'newsletter':
                $newsletter = Newsletter::all();
                $recivers = [];
                foreach ($newsletter as $newsletter) {
                    $recivers[] = $newsletter->email;
                }
            break;
        }
        // if($mail_img_path) {
        //     $data = [
        //         'subject' => 'HMS Notification',
        //         'title' => $mail->title,
        //         'description' => $mail->description,
        //         'type' => $mail->type,
        //         'content' => $mail->content,
        //         'path' => $mail_img_path,
        //     ];
        // }else {
        //     $data = [
        //         'subject' => 'HMS Notification',
        //         'title' => $mail->title,
        //         'description' => $mail->description,
        //         'type' => $mail->type,
        //         'content' => $mail->content,
        //         'path' => '',
        //     ];
            $data = [
                'subject' => 'HMS Notification',
                'title' => $mail->title,
                'description' => $mail->description,
                'type' => $mail->type,
                'content' => $mail->content,
                'path' => '',
            ];
        try {
            Mail::to($recivers)->send(new MailNotify($data));
            Toast::title(Lang::get('toast.mail_sent'));
            return redirect()->back();
        } catch (Expectation $th) {
            return response()->json('not nice');
        }
    }
}
