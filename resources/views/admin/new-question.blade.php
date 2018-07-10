@extends('layouts.admin')

@section('content')
<div class="container">
     <div class="row">
          <div class="col-md-8 col-md-offset-2">
               <div class="panel panel-default">
                    
                    <div class="panel-body">                         
                         <form class="form-horizontal" method="POST" action="/question/save">
                              {{ csrf_field() }}
                              
                              <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                   <label for="title" class="col-md-4 control-label">Question</label>
                                   
                                   <div class="col-md-6">
                                       <textarea id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus></textarea>
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
                                            <option value="General">General</option>
                                            <option value="Objective">Objective</option>
                                            <option value="Comments">Comments</option>                                      
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
                                        <select  id="question_type" class="form-control select-question-type" name="question_type" value="{{ old('question_type') }}" required >
                                             <option value="">--SELECT--</option>                                   
                                             <option value="fillintheblank">Fill in The Blank</option>
                                             <option value="textarea">Textarea</option>
                                             <option value="truefalse">True Or False</option>
                                             <option value="single">Single Select</option>
                                             <option value="multiple">Multiple Select</option>
                                             <option value="ratings">Ratings(1-5)</option>                                        
                                        </select>
                                        @if ($errors->has('question_type'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('question_type') }}</strong>
                                        </span>
                                        @endif
                                   </div>

                                   <div class="col-md-2 add-button">
                                      <button class="btn btn-success" id="add">Add Options</button>
                                   </div> 
                              </div>
                     
                              <div class="question-choices">                                 
                              </div>
                              
                              
                              
                              
                              <div class="form-group">
                                   <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                             Submit
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