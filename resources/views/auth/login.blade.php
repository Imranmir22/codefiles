
<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
@section('content')

    <h2>Log In</h2>
    <div class="container">
        @if(Session::has('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif

    <form method="POST" action="/sign-in">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
        </div>
        @if($errors->has('email'))
        <div class="error">{{ $errors->first('email') }}</div>
        @endif
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        @if($errors->has('password'))
        <div class="error">{{ $errors->first('password') }}</div>
        @endif
        <div class="d-flex flex-inline">
            <div class="form-group mt-2">
                <button style="cursor:pointer" type="submit" class="btn btn-primary ">Login</button>
            </div>
            <div class="form-group mt-2 ms-2">
                <a href="{{ url('/register') }}" style="cursor:pointer" class="btn btn-primary">Register</a>
            </div>
        
         </div>
    </form>
</div>

