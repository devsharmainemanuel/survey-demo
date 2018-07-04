<?php

namespace App\Http\Controllers;
use App\Question;
use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\DB;
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
        $questions =  Question::where('status', 'published')->get();
        return view('home', compact('questions'));  

    }
    
    public function store_survey(Request $requests){
        $request = $requests->except('_token');

        $this->validate($requests, [
            'answer' => 'required',
        ]);

        //get all submitted data
        $answers = $request['answer'];
        $id = $request['user_id'];

 
        $data = array();
        

        //loop every answer and store each answer
        foreach ($answers as $key => $value) {
   
            $answer = new Answer();            
            $answer->question_id = $key;
            $answer->answer = $value;
            $answer->user_id =  $request['user_id'];
            $answer->survey_id =  1;
            $answer->save();
            
        }       
        return redirect('home');
        
    }
}
