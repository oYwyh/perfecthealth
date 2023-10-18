<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Models\Mail;
use App\Tables\Mails;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;

class AdminMailController extends Controller
{
    public function index() {
        if(Session::get('locale') == 'en') {
            SEO::title('Mails | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('البريد | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.admin.manage.mails.index',
            [
                'mails' => Mails::class
            ]
        );
    }
    public function add() {
        if(Session::get('locale') == 'en') {
            SEO::title('Add | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('إضافة | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        $types = [
            'announcement',
            'lol'
        ];
        return view('dashboard.admin.manage.mails.add',
            [
                'types' => $types,
            ]
        );
    }
    public function create(Request $req) {
        $req->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'type' => 'required',
        ]);
        $content = $req->content;
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image\/(gif|jpeg|png);base64,/i', $src)) {
                $type = explode(';', $src)[0];
                $type = explode('/', $type)[1]; // get the image type
                $src = str_replace('data:image/' . $type . ';base64,', '', $src);
                $src = str_replace(' ', '+', $src);
                $fileName = 'mail_image_' . time() . '_' . Str::random(10) . '_' . uniqid() . '.' . $type;
                $filePath = storage_path(). '/app/public/images/mails/' . $fileName;
                if (File::put($filePath, base64_decode($src))) {
                    $img->setAttribute('src', url('/') . '/storage/images/mails/' . $fileName);
                } else {
                    throw new \Exception('Failed to save image at ' . $filePath);
                }
            }
            $new_src = $img->getAttribute('src');
        }
        $content = $dom->saveHTML();
        $mail = new Mail();
        $mail->title = $req->title;
        $mail->description = $req->description;
        $mail->content = $content;
        $mail->type = $req->type;
        $mail->save();
        Toast::success(Lang::get('toast.mail_created'));
        return redirect()->route('admin.manage.mails.index');
    }
    public function send(Request $req) {
        $formField = $req->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'type' => 'required',
            'recivers' => 'required',
        ]);
        $content = $req->content;
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image\/(gif|jpeg|png);base64,/i', $src)) {
                $type = explode(';', $src)[0];
                $type = explode('/', $type)[1]; // get the image type
                $src = str_replace('data:image/' . $type . ';base64,', '', $src);
                $src = str_replace(' ', '+', $src);
                $fileName = 'mail_image_' . time() . '_' . Str::random(10) . '_' . uniqid() . '.' . $type;
                $filePath = storage_path(). '/app/public/images/mails/' . $fileName;
                if (File::put($filePath, base64_decode($src))) {
                    $img->setAttribute('src', url('/') . '/storage/images/mails/' . $fileName);
                } else {
                    throw new \Exception('Failed to save image at ' . $filePath);
                }
            }
            $new_src = $img->getAttribute('src');
        }
        $content = $dom->saveHTML();
        $mail = Mail::find($req->id);
        $mail->content = $content;
        $mail->title = $req->title;
        $mail->description = $req->description;
        $mail->type = $req->type;
        $mail->recivers = $req->recivers;
        $mail->save();
        Session::put('mail_id', $req->id);
        // if(isset($new_src)) {
        //     Session::put('mail_img_path', $new_src);
        // }
        return redirect()->route('admin.manage.mails.send');
    }
    public function confirm(Request $req) {
        if(Session::get('locale') == 'en') {
            SEO::title('Send | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('إرسال | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        $types = [
            'announcement',
            'lol'
        ];
        return view('dashboard.admin.manage.mails.confirm',[
            'id'=> $req->id,
            'types' => $types,
            'mail' => Mail::find($req->id),
        ]);
    }
    public function remove(Request $req) {
        $mail = Mail::find($req->id);
        $mail->delete();
        Toast::success(Lang::get('toast.mail_deleted'));
        return redirect()->route('admin.manage.mails.index');
    }
}
