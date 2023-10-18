<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
    ];

    public function scopeFilter($query, array $filters) {
        // $filters['tag] != false
        if($filters['tag'] ?? false) {
            // TODO Search For Tags In DB Wich Match request('tag')
            // SELECT * FROM tags WHERE tags Like %request('tag')%
            $query->where('tags_ar','like','%'. request('tag'). '%')
                    ->orWhere('tags','like','%'. request('tag'). '%');
        }
        if($filters['search'] ?? false) {
            // TODO Search For Tags In DB Wich Match request('tag')
            // SELECT * FROM tags WHERE tags Like %request('tag')%
            $query->where('title','like','%'. request('search'). '%')
                    ->orWhere('description','like','%'. request('search'). '%')
                    ->orWhere('tags_ar','like','%'. request('search'). '%')
                    ->orWhere('tags','like','%'. request('search'). '%')
                    ;
        }
    }

}
