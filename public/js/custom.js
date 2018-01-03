    $('#submit').click(function(){
            var urlData  = $('#url').val();
            var token    = $('meta[name=csrf-token]').attr('content');

            if(urlData == ''){
                alert('You forgot to enter url');
                return false;
            }
            
            var urlArr = urlData.split(',');
            
            $('#result').empty();
            
            $.each(urlArr, function( index, value ) {
              sendRequest(value, token);
            });
    });

    /**
     *   Method to send ajax request to home controller and get page title
     *   append page title in result area 
     *  
     */ 
    function sendRequest(url, token){
        showLoading();
        $.ajax({
            url     : 'search',
            type    : 'post',
            data    : {urlData : url , _token : token}, 
            success : function(response) {
                        $('#result').append('<p>'+response+'</p>');             
                        hideLoading();
            },
            error   : function(errResponse){

                      hideLoading();
                      $('#result').append('<p style="color:red;">something went wrong on server. please try later</p>');
            }          
        });
    }

    function showLoading(){
       $('#loading').show();
    }

    function hideLoading(){
       $('#loading').hide();
    }