<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laravel Application</title>
  <meta charset="utf-8">
  <meta content="{{csrf_token()}}" name="csrf-token" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Laravel </a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="{{url('/home')}}">Home</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{url('/logout')}}"> Logout</a></li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <h2>Get Title from url</h2>
      <br/>
      
        <form class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-2 control-label">Add Url</label>
              <div class="col-sm-10">
                <textarea rows="6" name="url" id="url" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <button class="btn btn-primary pull-right" id="submit" type="button">Submit</button>
            </div>
        </form>

        <br/>
        <h3 class="text-center">Result <img src="{{asset('images/loading.gif')}}" width="100" style="display: none;" id="loading"></h3>
        <div class="well text-center" id="result">
          
        </div>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script src="{{asset('js/custom.js')}}"></script> 
</html>
