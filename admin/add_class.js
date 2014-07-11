
var valid= true;
var nos = 1;
      $('#add-one').click(function(){
        add(1);
      });

      $('#add-more').click(function(){
        var val = $('#add_nos').val();
        if(val>0){
        add(val);
        }
      });

      function validate(){
          
          var success = 0;
          if(!valid) return false;
          $('.status').html('<img src="../img/spinner.gif">');
          $('.btn').attr('disabled','disabled');
          for(var i =0; i<nos;i++){
            var n = '#name'+i;
            var e = '#email'+i; 

            $(e).attr('disabled','disabled');
            $(n).attr('disabled','disabled');
          }
           for(var i =0; i<nos;i++){
            var n = '#name'+i;
            var e = '#email'+i; 

            
          
            var em  = $(e).val();
            var na= $(n).delay(1000).val();
             
            var id = '#status'+i;
             var xhr =  $.ajax({
                  type: "post",
                  url: "add_student.php",
                  data: { name: na ,email: em },
                  cache: false,
                  async: false
                })
                  .done(function( html ) {

                      var suc = html.split('<br>');
                      suc = suc[0];
                      //alert(suc);
                      if(suc=='true'){
                       
                         $(id).html('<span class="glyphicon glyphicon-ok" ></span>');
                         
                         $(id).parent().addClass('success');
                         success++;
                         
                      }
                      else{
                        
                         $(id).empty();
                         $(id).html('<span class="glyphicon glyphicon-remove" ></span>');
                         $(id).parent().addClass('danger');
                      }

                  });

          }
          setInterval(checkAll,1000,success,nos);
          return false;
      }

      function checkAll(success, nos){
        if(success==nos){
          alert('All Students succesfully added to Database!');
          window.location.href="add_class.php?clear";
        }
      }




      $('#sub-one').click(function(){
        var str = '[row-no='+nos+']';
        if(nos>1){
        $(str).remove();
        nos--;
        }
        if(nos==1){
          $(this).attr('disabled','disabled');
        }
      });

      function add(n){
          for(var i =0;i<n;i++){
                var str = '<tr row-no="'+(nos+1)+'"><th>'+(nos+1)+'</th><td><input type="text" class="name-entry form-control" id="name'+nos+'" required></td><td><input type="email" class="email-entry form-control" status="status'+nos+'" id="email'+nos+'"  required></td><td class="status" id="status'+nos+'" ></td></tr>';
                $('.table').append(str);
                nos=nos+1;
          }
          $('#sub-one').removeAttr('disabled');
          remap();
      }

     

     

     function remap(){
        
            $('.email-entry').change(function(){
          $('[data-toggle=popover]').popover('hide');
          var em = $(this).val();
          //alert(em);
            var txt = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
            var id ='#'+$(this).attr('status');
            var row = $(this);
            if (!txt.test(em)) {
              valid=false;
             $(id).html('<span class="glyphicon glyphicon-remove" data-container="body" data-toggle="popover" data-placement="right" data-content="YOu have entered Invalid Email ID" ></span>');
                 $('[data-toggle=popover]').popover({
                      trigger: 'hover'
                    });
                 $('[data-toggle=popover]').popover('show');
                 $(id).parent().addClass('danger');
            }else{
                 var xhr =  $.ajax({
                  type: "get",
                  url: "email_check.php",
                  data: { email: em },
                  cache: false
                })
                  .done(function( html ) {

                      var found = html.split('<br>');
                      
                      found = found[0];
                      if(found=='true'){
                        valid= false;
                         $(id).html('<span class="glyphicon glyphicon-remove" data-container="body" data-toggle="popover" data-placement="right" data-content="User already Exists." ></span>');
                         $('[data-toggle=popover]').popover({
                              trigger: 'hover'
                            });
                         $('[data-toggle=popover]').popover('show');
                         $(id).parent().addClass('danger');
                      }
                      else{
                        valid =true;
                         $(id).empty();
                         $(id).parent().removeClass('danger');
                      }
                      
                  });
            }

           
           });

     }


     remap();



      

      