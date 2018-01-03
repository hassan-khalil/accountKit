<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                /*font-family: 'Raleway', sans-serif;*/
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                /*text-align: center;*/
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
          <div class="row">
            @if(Session::has('serverError'))
              <div class="container" style="">
                <p class="alert alert-danger text-center"> {{ Session::get('serverError') }}</p>
              
              </div>
            @endif
          </div>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <h3>Verify Phone Number</h3>
               <div>
                 <form action="/login" method="post" id="form">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="code" id="code" />
                </form>
                    <div class="row">
                        <div class="form-group">
                            <label>Country Code *</label>
                            <input type="text" class="form-control" id="country" value="+92" required autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label>Number *</label>
                            <input type="text" class="form-control" id="phone" required autocomplete="off" />
                        </div>
                    </div>
                    <button onclick="smsLogin()" class="btn btn-primary" />Get Started</button>
                </div>

                
            </div>
        </div>
    </body> 
  <script type="text/javascript" src="https://sdk.accountkit.com/en_US/sdk.js"></script>
  <script type="text/javascript">
      AccountKit_OnInteractive = function() {
          AccountKit.init({
            appId: '528222377550401',
            state: document.getElementById('_token').value,
            version: 'v1.0'
          });
        };

        function loginCallback(response) {
          console.log(response);

          if (response.status === "PARTIALLY_AUTHENTICATED") {
            document.getElementById('code').value = response.code;
            document.getElementById('_token').value = response.state;
            document.getElementById('form').submit();
          }

          else if (response.status === "NOT_AUTHENTICATED") {
              // handle authentication failure
              alert('You are not Authenticated');
          }
          else if (response.status === "BAD_PARAMS") {
            // handle bad parameters
            alert('wrong inputs');
          }
        }

        function smsLogin() {
          var countryCode = document.getElementById('country').value;
          var phoneNumber = document.getElementById('phone').value;
          console.log(phoneNumber);
          if(phoneNumber == '' || phoneNumber == null){
                alert('Phone Number is required');
          }else{
              AccountKit.login(
                'PHONE',
                {countryCode: countryCode, phoneNumber: phoneNumber},
                loginCallback
              );
            
          }
        }
  </script>
</html>
