$( function() {
     $('.add-button').hide();
     var selected = $('.select-question-type').val();

     if(selected == "multiple" || selected == "single") {
          $('.add-button').show();
     }
     else{
          
     }
     
     $('.select-question-type').on('change',function(){
          $('.question-choices').empty();
          var selected = $(this).val()

          if(selected == "multiple" || selected == "single"){
               $('.add-button').show();
          }
          else{
               $('.add-button').hide();
          }
          console.log(selected);
     });
     $('#add').on('click', function( e ) {     
          e.preventDefault();
          var id = $('.question_id').val() != undefined ? $('.question_id').val() : "";  
          var data="";
          data +=  "<div class='form-group'>";
          data +=  " <label for='question_type' class='col-md-4 control-label'>Option</label>";
          data +=  "<div class='col-md-4'><input type='text' name='options["+id+"]' class='form-control' required></div>";
          data +=  "<div class='col-md-2'><button class='btn btn-danger remove'>X</button></div></div>";    
          $('.question-choices').append(data);
          
     });
     
     $('#add_update').on('click', function( e ) {
          e.preventDefault();          
          var id = $('.question_id').val() != undefined ? $('.question_id').val() : "";      
          var data="";
          data +=  "<div class='form-group'>";
          data +=  " <label for='question_type' class='col-md-4 control-label'>Option</label>";
          data +=  "<div class='col-md-4'><input type='text' name='options["+id+"][]' class='form-control' required></div>";
          data +=  "<div class='col-md-2'><button class='btn btn-danger remove'>X</button></div></div>";    

          $('.question-choices').append(data); 
     });


     $('.question-choices').on('click','.remove',function( e ) {
          e.preventDefault();
          $(this).closest( 'div.form-group' ).remove();
    });
     
});