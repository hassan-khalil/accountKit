
    $('#submit').click(function(){
            var urlData  = $('#url').val();
            var token    = $('meta[name=csrf-token]').attr('content');
            var postUrl      = 'search';
            
            if(urlData == ''){
                alert('You forgot to enter url');
                return false;
            }
            
            showLoading();
            $.ajax({
                url     : postUrl,
                type    : 'post',
                data    : {urlData : urlData , _token : token}, 
                success : function(response) {
                            $('#result').empty();             
                            $.each( response, function( key, value ) {
                               $('#result').append('<p>'+value+'</p>');             
                            });
                          hideLoading();
                },
                error   : function(errResponse){
                          hideLoading();
                          $('#result').empty().html('<p style="color:red;">something went wrong on server. please try later</p>');
                }          
            });
            
    });

    function showLoading(){
       $('#loading').show();
    }

    function hideLoading(){
       $('#loading').hide();
    }