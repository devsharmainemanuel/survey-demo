@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        
        <div class="panel-body">                         
          <form class="form-horizontal" method="POST" action="/question/update">
            {{ csrf_field() }}
            
            <input type="hidden" name="question_id" value="{{$question->id}}" class="question_id">
            <input type="hidden" name="old_question_type" value="{{$question->question_type}}" class="question_id">
            
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
              <label for="title" class="col-md-4 control-label">Question</label>
              
              <div class="col-md-6">
                <textarea id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>{{$question->title}}</textarea>
                @if ($errors->has('title'))
                <span class="help-block">
                  <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('question_category') ? ' has-error' : '' }}">
              <label for="question_category" class="col-md-4 control-label">Question Category</label>
              
              <div class="col-md-4">
                <select  id="question_category" class="form-control " name="question_category" value="{{ old('question_category') }}"  >
                  <option value="">--SELECT--</option>
                  <option value="General"  @if($question->question_category == "General")selected="selected" @endif >General</option>
                  <option value="Objective" @if($question->question_category == "Objective")selected="selected" @endif >Objective</option>
                  <option value="Comments" @if($question->question_category == "Comments")selected="selected" @endif  >Comments</option>                                      
                </select>
                @if ($errors->has('question_category'))
                <span class="help-block">
                  <strong>{{ $errors->first('question_category') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('question_type') ? ' has-error' : '' }}">
              <label for="question_type" class="col-md-4 control-label">Question Type</label>
              
              <div class="col-md-4"> 
                <select  id="question_type" class="form-control select-question-type" name="question_type" value="{{ old('question_type') }} " required  >
                  <option value="">--SELECT--</option>
                  <option value="fillintheblank"  @if($question->question_type == "fillintheblank")selected="selected" @endif >Fill in The Blank</option>
                  <option value="textarea"  @if($question->question_type == "textarea")selected="selected" @endif >Textarea</option>
                  <option value="truefalse" @if($question->question_type == "truefalse")selected="selected" @endif>True Or False</option>
                  <option value="single" @if($question->question_type == "single")selected="selected" @endif>Single Select</option>
                  <option value="multiple" @if($question->question_type == "multiple")selected="selected" @endif>Multiple Select</option>
                  <option value="ratings" @if($question->question_type == "ratings")selected="selected" @endif>Ratings(1-5)</option>    
                </select> 
                
                
                @if ($errors->has('question_type'))
                <span class="help-block">
                  <strong>{{ $errors->first('question_type') }}</strong>
                </span>
                @endif
              </div>
              <div class="col-md-2 add-button">
                <button class="btn btn-success" id="add_update" >Add Options</button>
              </div> 
            </div>
            
            
            
            <div class="question-choices">
        
              @if($question->question_type == "multiple" || $question->question_type == "single")              
              @foreach($question->options as $option) 
              <div class="form-group ">
                <label for="question_type" class="col-md-4 control-label">Option</label>
                <div class="col-md-4">                                                          
                  <input type="text" class="form-control" name="options[{{$question->id}}][{{$option->id}}]" data-id="{{$option->id}}" value="{{$option->text}}">                      
                </div>                                      
                <div class="col-md-2"><button class="btn btn-danger remove">X</button></div>
              </div>         
              @endforeach              
              @endif
            </div>
            
            
            
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Update
                </button>
              </div>
            </div>
          </form>                           
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('script')
<script src="{{ asset('js/options.js') }}"></script>
@endsection