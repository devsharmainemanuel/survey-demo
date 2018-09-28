@extends('layouts.app')

@section('content')
<div class="page-header">
          <div class="row">
               <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-tasks page-header-icon"></i>Survey</h1>
               <div class="col-xs-12 col-sm-8">
                    <div class="row">
                         {{--  <a href="survey/category/create" class="btn btn-primary pull-right"><span class="btn-label icon fa fa-plus"></span> Add Category</a>  --}}
                         <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addCategoryModal"><span class="btn-label icon fa fa-plus"></span> Add Category</button>
                         
                    </div>
               </div>
          </div>
     </div>
<div class="container">

     
     <div class="row">
          <div class="col-md-12">
               <div class="panel panel-default">
                    <div class="panel-heading">
                         <div class="row">
                              <div class="col-md-9 col-xs-12"> Survey  </div>
                              <div class="col-md-3 col-xs-12">
                                   {{--  <a href="survey/create" class="btn btn-primary pull-right "><span class="btn-label icon fa fa-plus"></span> Create Survey</a>  --}}
                                   <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#createSurveyModal"><span class="btn-label icon fa fa-plus"></span> Create Survey</button>
                                   
                              </div>
                              
                         </div>
                    </div>                    
                    <div class="panel-body">     
                         
                         <form class="form-horizontal" method="POST" action="/survey/sort">
                              {{ csrf_field() }}
                              
                              
                              <ul class="list-group sortable" id="sortable">
                                   
                                   {{--  @foreach ($questions as $question)
                                   
                                   <li class="list-group-item list-question" data-id="{{$question->id}}" data-survey-id="{{$question->survey_id}}">                                    
                                        <a href="/question/{{$question->id}}/edit">   {{$question->title}}</a>
                                        <span class="pull-right">
                                             <a href="/question/{{$question->id}}/delete"> <span class="btn btn-xs btn-default" >delete</span></a>
                                        </span>
                                   </li>  
                                   
                                   @endforeach  --}}
                              </ul>
                         </form>
                    </div>
               </div>
          </div>
          
          
     </div>
</div>


<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategory" aria-hidden="true">
          <div class="modal-dialog">
               <div class="modal-content">
                    <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                         <h4 class="modal-title" id="addCategory">Add Category</h4>
                    </div>
                         <div class="modal-body">
                              <form action="/survey/category/create" method="POST" class="addCategoryForm form">
                                   {{ csrf_field() }}                                   
                                   <div class="row">
                                          <div class="form-group">
                                            <input type="text" name="category_name"  value="{{ old('category_name') }}" class="form-control" placeholder="Category name">
                                             
                                              @if ($errors->has('category_name'))
                                              <span class="help-block">
                                                   <strong>{{ $errors->first('category_name') }}</strong>
                                              </span>
                                              @endif
                                         </div>
                                          <div class="form-group">
                                             <textarea id="category_description" type="text" class="form-control" name="category_description" value="{{ old('category_description') }}" required autofocus placeholder="Category Description"></textarea>
                                              @if ($errors->has('category_description'))
                                              <span class="help-block">
                                                   <strong>{{ $errors->first('category_description') }}</strong>
                                              </span>
                                              @endif
                                         </div>
                                         <div class="form-group pull-right">
                                              <button class="btn" type="submit">Submit</button>
                                         </div>
                                   </div>
                               </form>
                    </div>
               </div>
          </div>
     </div>


     <div class="modal fade" id="createSurveyModal" tabindex="-1" role="dialog" aria-labelledby="createSurvey" aria-hidden="true">
               <div class="modal-dialog">
                    <div class="modal-content">
                         <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                              <h4 class="modal-title" id="createSurvey">Create Survey</h4>
                         </div>
                              <div class="modal-body">
                                   <form action="/survey/create" method="POST" class="createSurveyForm form">
                                        {{ csrf_field() }}                                   
                                        <div class="row">
                                               <div class="form-group">
                                                 <input type="text" name="category_name"  value="{{ old('category_name') }}" class="form-control" placeholder="Survey name">
                                                  
                                                   @if ($errors->has('category_name'))
                                                   <span class="help-block">
                                                        <strong>{{ $errors->first('category_name') }}</strong>
                                                   </span>
                                                   @endif
                                              </div>
                                               <div class="form-group">
                                                  <select class="form-control">
                                                       <option>Please select a category</option>
                                                       <option>Community</option>
                                                  </select>
                                              </div>
                                              <div class="form-group pull-right">
                                                   <button class="btn" type="submit">Submit</button>
                                              </div>
                                        </div>
                                    </form>
                         </div>
                    </div>
               </div>
          </div>
     

     @endsection


@section('script')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
     $( function() {
          
          $.ajaxSetup({
               headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
          });
          $('#sortable').sortable({
               update: function (event, ui) {
                    $data = [];
                    
                    $(".list-question").each(function( index ) {                         
                         $obj = {
                              'question_id' : $( this ).attr('data-id'),
                              'survey_id' : $( this ).attr('data-survey-id'),
                              'order' : index
                         }
                         
                         $data.push($obj);
                         
                    });
                   
                    // POST to server using $.post or $.ajax
                    $.ajax({
                         data: {'data' : $data},
                         type: 'POST',
                         url: '/api/survey/sort'
                         
                    }).success(function(data) {
                       //  console.log(data);
                     })
                     .error(function(data) { 
                         alert('Error: ' + data); 
                     });
               }
          });         
     } );
</script>
@endsection