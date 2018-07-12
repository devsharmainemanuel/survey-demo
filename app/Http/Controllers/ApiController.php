<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function get_questions()
    {
        $questions = Question::where('status', 'published')->orderBy('sort_order')->get();
        foreach ($questions as $key => $value) {
            $value->options;
        }

        return json_encode($questions);
    }

    public function submit_survey(Request $request)
    {
        //planning to change this to Guest Model
        try {
            $user = new User();
            $user->name = $request['username'];
            $user->email = str_random(10);
            $user->password = str_random(10);
            $user->save();

            if ($user->save()) {
                foreach ($request['questions'] as $key => $value) {
                    try {
                        $answer = new Answer();
                        $answer->question_id = $value['id'];
                        $answer->answer = $value['value'];
                        $answer->user_id = $user->id;
                        $answer->survey_id = 1;
                        $answer->save();
                    } catch (\Exception $e) {
                        return $e->getMessage();
                    }
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return json_encode($request);
    }
}
