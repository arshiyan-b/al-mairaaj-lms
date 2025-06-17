<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Al Mairaaj</title>
    <link rel="icon" type="image/png" href="{{ asset('build/assets/book_logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <style>

    .sidenav {
        width: 40%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #000; 
        color: #fff;
        padding: 20px;
    }


    .login-main-text {
        margin-top: 50%;
        margin-left: 20%;
        font-size: 1.5rem;
    }

    .main {
        
        margin-left: 40%;
        padding: 20px;
        box-sizing: border-box;
    }

    .login-form {
        margin-top: 40%; /* 15px gap below the navbar */
        padding: 20px;
        background-color: #f8f9fa; /* Light background for the form */
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    input{
        margin-top: 5px;
        margin-bottom: 8px; 
    }

    button{
        margin-top: 15px;
    }

    @media screen and (max-width: 768px) {
        .sidenav {
            width: 100%;
            position: relative;
            height: 275px;
        }
        .login-main-text {
            margin-top: 45%;
        }

        .main {
            margin-left: 0;
        }

        .login-form {
            margin-top: 8%; 
        }
    }
    .form-control:focus,
    .form-control:hover {
        border-color: black !important;
        box-shadow: 0 0 0 0.25rem rgba(0, 0, 0, 0.25) !important;
    }

  </style>
<body>
    <div class="sidenav">
         <div class="login-main-text">
            <h2>Al Mairaaj</h2>
            <h2>Login to proceed</h2>
         </div>
    </div>
    <div class="main">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form action="{{ route('admin.auth') }}" method="POST">
                @csrf
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-dark">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>