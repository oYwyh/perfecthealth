<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribe(Request $req) {
        $validator = Validator::make($req->all(), [
            'email' => 'required|email|unique:newsletters,email',
        ]);
        if ($validator->fails()) {
            return Toast::danger('Error')
            ->message($validator->errors()->first('email'))
            ->autoDismiss(5);
        }
        $news = new Newsletter();
        $news->email = $req->email;
        $news->save();
        Toast::info(Lang::get('toast.newsletter'))
        ->autoDismiss(5);
        return redirect()->back();
    }
}
