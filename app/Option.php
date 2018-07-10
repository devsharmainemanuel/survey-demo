<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
    protected $table = 'options';
    protected $fillable = ['id', 'question_id', 'text'];
    protected $primaryKey = 'id';
    
    public function options()
    {
        return $this->belongsTo(Question::class);
    }
}
