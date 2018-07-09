<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Option;

class ApiController extends Controller
{

    public function get_questions(){
        $questions =  Question::where('status', 'published')->orderBy('sort_order')->get();
        $data = [];
        foreach ($questions as $key => $value) {    
            $value->options;
        }
        return $questions;
    }

    public function submit_survey(Request $request){
        return $request['answers'];
    }        
}
