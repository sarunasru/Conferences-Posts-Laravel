<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    public function setPostImageAttribute($value)
//    {
//       $this->attributes['post_image'] = asset($value);
//    }

    public function getPostImageAttribute($value)
    {

        if($this->attributes['post_image'] == null)
        {
            return asset($value);
        }
        elseif (Storage::exists($this->attributes['post_image'])) {
            return asset('storage/' . $value);
        }
        else  {
            return asset($value);
        }


    }
}
