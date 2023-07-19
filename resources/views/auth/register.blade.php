<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>


    <h2>Register</h2>
    <div class="container">
    <form method="POST" action="/add-user" enctype='multipart/form-data'>
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>
        @if($errors->has('name'))
        <div class="error">{{ $errors->first('name') }}</div>
        @endif
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
        <div class="form-group">
            <label for="profile">Profile Image:</label>
            <input type="file" class="form-control" id="profile" name="profile">
        </div>
        @if($errors->has('profile'))
        <div class="error">{{ $errors->first('profile') }}</div>
        @endif
        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
