<?php use App\Http\Controllers\UserController ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/utils/normalize.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>Laragram - Login</title>
</head>
<body>
    @include('layout.header')
    <main id='login'>
        <form action="{{action([UserController::class, 'login'])}}" method='post'>{{csrf_field()}}
            <h1>Laragram</h1>
            <p>Log In to see photos from your friends</p>
            <label for="email">Email:</label>
            <input name='email' type="email">
            
            <label for="password">Password:</label>
            <input name='password' type="password">
            
            <button type="submit">Log In</button>
            @if(session('error')) 
                <p class='error'>{{session('error')}}</p>
            @endif
        </form>
    </main>
</body>
</html>