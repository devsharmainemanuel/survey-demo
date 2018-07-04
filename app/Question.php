<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //==
  protected $fillable = ['title', 'question_type', 'user_id'];

  protected $casts = [
    'id' => 'array',
];
}
