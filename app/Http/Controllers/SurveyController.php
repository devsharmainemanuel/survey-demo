<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use Illuminate\Http\Response;
class SurveyController extends Controller
{
    
    
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    
    
    public function home(Request $request) 
    {
        $title = "Laravel Survey";        
        return view('home', compact('title'));
    }
    
    public function index()
    {
        //display published questions
        $questions =  Question::where('status', 'published')->get();
        
        //display archieved questions
        $archieves =  Question::where('status', 'deleted')->get();
        return view('admin.survey', compact('questions','archieves'));
        
    }
    
    public function new_question(){
        return view('admin.new-question');
    }
    public function store_question(Request $request){
        
        $arr = $request->except('_token');
        
        //store submitted data to Question
        $question = new Question();
        $question->title = $request->title;
        $question->question_category = $request->question_category;
        $question->question_type = $request->question_type;
        $question->status = "published" ;
        $question->survey_id = 1 ;
        $question->save();
        
        return redirect('/survey');
    }
    public function update_question(Request $request){
        
        $question = Question::find($request->question_id);          
        $question->title = $request->title;
        $question->question_type = $request->question_type;
        $question->update();
        
        return redirect('/survey');
    }
    public function edit_question($id){      
        
        //get question by id 
        $question =  Question::where('id', $id)->first();
        
        return view('admin.edit-question', compact('question'));
    }
    
    public function delete_question($id){      
        $question = Question::find($id);              
        $question->status = "deleted";
        $question->update();
        
        return redirect('/survey');
    }
    
    public function retrieve_question($id){  
        //get question by id and update to published
        $question = Question::find($id);            
        $question->status = "published";
        $question->update();
        
        return redirect('/survey');
    }
    
    
    public function view_results(){

        $answers = Answer::distinct()->get(['user_id']);
   

        return view('admin.survey-results',compact('answers'));
    }
    
    public function view_archives()
    {        
        //display archieved questions
        $archieves =  Question::where('status', 'deleted')->get();
        return view('admin.retrieve-question', compact('archieves'));
        
    }

    public function user_result($id){

        $questions =  Question::where('status', 'published')->get();
        $answers  = Answer::where('user_id',$id)->get();

        $user_answer = [];

        foreach ($answers as $key => $value) {
            # code...
            $user_answer = array(
                'questions' => $questions,
                'answers' =>   $value
            );
        }

        return view('admin.user-result', compact('questions','answers','user_answer')); 
    }
}
