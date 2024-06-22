<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail',
    ];

    protected $appends = ['gender_text'];

    public function getGenderTextAttribute()
    {
        $genders = ['男性', '女性', 'その他'];
        return $genders[$this->gender];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
