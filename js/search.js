      var xhr = null;

      
      $('#search-input').keyup(function(){
          $('#search-result').append('<li><img id="loading" src="../img/spinner.gif"/></li>');
          var inp = $(this).val();
          $.ajax({
              type: "get",
              url: "search.php",
              data: { q: query ,no :n},
              cache: false
            })
              .done(function( html ) {
                  $(container).empty();
                $( container ).append( html );
              });

      });


        function search(query,container,n){
            $(container).append('<img id="loading" src="spinner.gif"/>');
            $.ajax({
              type: "get",
              url: "fetch.php",
              data: { q: query ,no :n},
              cache: false
            })
              .done(function( html ) {
                  $(container).empty();
                $( container ).append( html );
              });
        }
        var i =0;
         $(window).load(function() {
             
              for(i =0; i<10;i++){
                 $('#hot-container').append('<li id="cont'+i+'" class="list-group-item"></li>');
                loadPosts('hot','#cont'+i,i);
              }
              
         });

         $('#load-more-hot').click(function(){
             for(var j=0; j<10;i++,j++){
                 $('#hot-container').append('<li id="cont'+i+'" class="list-group-item"></li>');
                loadPosts('hot','#cont'+i,i);
              }

         });
         var ser = 10;
         var xhr = 0;

         document.getElementById('inc-search').onClick = function(){
            alert('hi');
            ser+=10;
             $('#search-results').append('<img id="loading" src="spinner.gif"/>');
            $('#search').keyup();
         };


         $('#search').keyup(function(){
                if(xhr!=0){
                  xhr.abort();
                }
                var val = $(this).val();
                       //alert (val);
                  xhr = $.ajax({
                    type: "get",
                    url: "fetch.php",
                    data: { q: 'topics' ,k :val,no:ser},
                    cache: false
                  })
                    .done(function( html ) {
                        $('#search-results').empty();
                        $('#search-results').append( html );
                        $('#search-results .list-group-item').click(function(){
                            $('#search-all').fadeOut('slow');
                              $('#search-all').fadeOut('slow');
                              document.getElementById('topicHeading').innerHTML = "Posts on "+this.innerHTML;
                              $('#trends').fadeIn("slow");
                              $('#hot').fadeIn("slow");
                        });
                        $('#inc-search').html('Load More..');
                        $('#inc-search').click(function(){
                           $('#inc-search').html('<img id="loading" src="spinner.gif"/>');
                          ser+=10;
                          $('#search').keyup();
                        });

                    });
         });

