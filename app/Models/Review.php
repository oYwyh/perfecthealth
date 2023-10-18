<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function getUserInfo($id,$info) {
        // return User::where('id', $id)->first()->$info;
    }

}
