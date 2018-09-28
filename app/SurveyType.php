<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyType extends Model
{
    //
    public function survey()
    {
        return $this->hasMany(Survey::class);
    }
}
