<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $table = 'answers';

    protected $fillable = [ 'user_id', 'question_id', 'survey_id', 'answer' ];

    public static function getUser($id)
    {
        $user = User::where('id', '=', $id)->first();

        return $user;
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
