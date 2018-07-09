<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //display only published questions
        $questions = Question::where('status', 'published')->orderBy('sort_order')->get();

        return view('home', compact('questions'));
    }

    public function store_survey(Request $requests)
    {
        $request = $requests->except('_token');

        // dd($request);

        $user = Auth::user()->id;

        //check if user already answer the survey
        $user_answer = Answer::where('user_id', $user)->get();

        if (count($user_answer) == 0) {
            //save only if the user has not yet answered the survey
            //get all submitted data
            $answers = $request['answer'];

            //loop every answer and store each answer
            foreach ($answers as $key => $value) {
                $answer_value = is_array($value) ? implode(',', $value) : $value;
                $answer = new Answer();
                $answer->question_id = $key;
                $answer->answer = $answer_value;
                $answer->user_id = $user;
                $answer->survey_id = 1;
                $answer->save();
            }

            return view('thankyou');
        } else {
            return redirect('home')->with('status', 'You have already answered the survey!');
        }
    }
}
