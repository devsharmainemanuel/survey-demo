@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row">
          @include('admin.partials.side-menu')
          
          <div class="col-md-10">
               <div class="panel panel-default">
                    <div class="panel-heading">
                         <div class="row">
                              <div class="col-md-9"> Survey Results  </div>                              
                         </div>
                    </div>                    
                    <div class="panel-body">                         
                         <ul class="list-group">
                              @foreach ($answers as $key => $value )
                              
                              <li class="list-group-item" >
                                   <a href="/survey/{{$value->id}}/edit"> {{$value}}</a>
                                   <span class="pull-right">
                                        <a href="/survey/{{$value->id}}/delete"> <span class="btn btn-xs btn-default" >delete</span></a>
                                   </span>
                              </li>  
                              
                              @endforeach
                         </ul>
                    </div>
               </div>
          </div>          
     </div>
</div>
@endsection
