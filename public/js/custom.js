  // Pusher.logToConsole = true;
  var pusher = new Pusher('enter-pusher-app-id', {
    cluster: 'us2',
    encrypted: false
  });

  var channel = pusher.subscribe('my-channel');

  // get title from pusher channel and append it in result area
  channel.bind('my-event', function(data) {
    $('#result').append('<p>'+data.message+'</p>');
  });

  $('#submit').click(function(){
    var urlData  = $('#url').val();
    var token    = $('meta[name=csrf-token]').attr('content');
    if(urlData == ''){
        alert('You forgot to enter url');
        return false;
    }

    $('#result').empty();
    sendRequest(urlData, token);
  });

  /**
   *   Method to send ajax request to home controller  with urls
   *
   */
  function sendRequest(urlData, token){
    showLoading();
    $.ajax({
        url     : 'search',
        type    : 'post',
        data    : {urlData : urlData , _token : token},
        success : function(response) {
                    // $('#result').append('<p>'+response+'</p>');
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
