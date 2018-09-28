<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function get_questions()
    {
        $questions = Question::where('status', 'published')->orderBy('sort_order')->get();
        foreach ($questions as $key => $value) {
            $value->options;
        }

        return $questions;
    }

    public function submit_survey(Request $request)
    {
        return $request['answer'];
    }

    public function getSurveyCategory()
    {
        $sub_cat = ['education','poll'];
        return $sub_cat;
    }

    public function submit_surveyCategory(Request $request)
    {
        return response()
        ->json($request['name']);

    }
}
