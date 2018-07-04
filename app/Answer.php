<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['user_id', 'question_id', 'survey_id','answer'];

    protected $hidden = [
        'user_id'
    ];
}
