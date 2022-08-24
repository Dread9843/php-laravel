<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Authentication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
             <div class=" col-md-4 col-md-offset-4" style="margin-top: 20px;">
             
                    <h5>Login Here</h5>
                    <hr>
                    <form action="{{route('login_user')}}" method="post">
                    @if(Session::has('success'))
                        <div class="alert alrert-success" role="alert"> {{Session::get('success')}}</div>
                        @endif

                        @if(Session::has('fail'))
                        <div class="alert alrert-danger" role="alert"> {{Session::get('fail')}}</div>
                        @endif
                        
                        @csrf
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{old('email')}}">
                            <span class="text-danger">@error('email') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" placeholder="Enter Password" name="password" value="">
                            <span class="text-danger">@error('password') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-success" type="submit"> Login </button>
                        </div>
                        <a href="registration"> Registed!!! Login here. </a>
                    </form>
                
            </div>
        </div>