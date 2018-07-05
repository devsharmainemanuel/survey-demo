<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\Option;
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
        $questions =  Question::where('status', 'published')->orderBy('sort_order')->get();
        
        return view('admin.survey', compact('questions','archieves'));
        
    }
    
    
    #CRUD QUESTIONS
    public function new_question(){
        return view('admin.new-question');
    }
    
    public function store_question(Request $request){
        
        $data = $request->except('_token');

        //store submitted data to Question
        $question = new Question();
        $question->title = $request->title;
        $question->question_category = $request->question_category;
        $question->question_type = $request->question_type;
        $question->status = "published" ;
        $question->survey_id = 1 ;
        $question->save();


        
        if($question->save() && $request->question_type == "multiple"){
            $id  = $question->id;            
            foreach ($data['option'] as $key => $value) {    
                $option = new Option();
                $option->question_id = $id;
                $option->text = $value;
                $option->save();
            }
        }

      
        return redirect('/survey');
    }
    
    public function update_question(Request $request){
     
        
      //  dd($request->all());
        $question = Question::find($request->question_id);    
        
     


        $question->title = $request->title;
        $question->question_type = $request->question_type;
        $question->update();
           if( $request->question_type == "multiple"){
            $id  = $request->question_id;            
            foreach ($request['answer'][$id] as $key => $value) {    
                $option = Option::find($key);
         
                if($option){
                   
                    $option->question_id = $id;
                    $option->text = $value;
                    $option->update(); 
                }
                else{
                    $option = new Option;
                    $option->question_id = $id;
                    $option->text = $value;
                    $option->save();
                }
               
            }
        }

        



        
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
    
    public function view_archives()
    {        
        //display archieved questions
        $archieves =  Question::where('status', 'deleted')->get();
        return view('admin.retrieve-question', compact('archieves'));
        
    }
    
    public function sort_questions(Request $request){
        
        $data = $request->all();
        
        $sample = [];
  
        foreach ($data['data'] as $key => $value) {
            $question = Question::find($value['question_id']);          
            $question->sort_order = $value['order'];        
            $question->update();  # code...
            
            
        }
        
        
        return $data;
        
    }
    
    #END CRUD QUESTIONS
    
    
    #RESULTS    
    public function view_results(){
        
        $answers = Answer::distinct()->get(['user_id']);
        
        
        return view('admin.survey-results',compact('answers'));
    }
    
    public function user_result($id){
        
        //get all answer of specific user
        $questions =  Question::where('status', 'published')->get();
        $answers  = Answer::where('user_id',$id)->get();
        
        return view('admin.user-result', compact('questions','answers')); 
    }
    #END RESULTS
}
