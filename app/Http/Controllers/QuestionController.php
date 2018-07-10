<?php

namespace App\Http\Controllers;

use App\Option;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
    
    public function new_question()
    {
        return view('admin.new-question');
    }
    
    public function edit_question($id)
    {
        //get question by id
        $question = Question::where('id', $id)->first();
        
        return view('admin.edit-question', compact('question'));
    }
    
    public function delete_question($id)
    {
        $question = Question::find($id);
        $question->delete();
        
        return redirect('/survey');
    }
    public function retrieve_question($id)
    {
        //get question by id and update to published
        $question = Question::withTrashed()->find($id)->restore();
        
        return redirect('/survey');
    }
    
    public function store_question(Request $request)
    {
        $data = $request->except('_token');
        
        //store submitted data to Question
        $question = new Question();
        $question->title = $request->title;
        $question->question_category = $request->question_category;
        $question->question_type = $request->question_type;
        $question->status = 'published';
        $question->survey_id = 1;
        $question->save();
        
        $type = $request->question_type;
        if (($type == 'multiple' || $type == 'single')) {
            $id = $question->id;
            foreach ($data['options'] as $key => $value) {
                $option = new Option();
                $option->question_id = $id;
                $option->text = $value;
                $option->save();
            }
        }
        
        return redirect('/survey');
    }
    
    public function update_question(Request $request)
    {
        $data = $request->except('_token');
      //  return $data;
        $question = Question::find($request->question_id);
        $question->title = $request->title;
        $question->question_type = $request->question_type;
        $question->question_category = $request->question_category;
        $question->update();
        $question_id = $request->question_id;
        $type = $request->question_type;

        if($request->old_question_type == "multiple" || $request->old_question_type == "single"){
            $option = Option::where('question_id', $question_id);
            $option->delete();
        }

        if (($type == 'multiple' || $type == 'single')) {                        
            foreach ($request['options'][$question_id] as $key => $value) {            
                $option = Option::updateOrCreate([
                    'id'            => $key,
                    'question_id'   => $question_id
                    ] ,['text' => $value]);                                        
                }
            }
            
            return redirect('/survey');
        }
    }
    