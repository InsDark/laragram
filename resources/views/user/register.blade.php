<?php use App\Http\Controllers\UserController ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/utils/normalize.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>Laragram - Register</title>
</head>
<body>
    @include('layout.header')
    <main id='register'>
        <form enctype='multipart/form-data' action="{{action([UserController::class, 'register'])}}" method='post'>
            {{csrf_field()}}
            <h1>Laragram</h1>
            <p>Register to see photos from your friends</p>

            <label for="name">Name:</label>
            <input name='name' type="text">

            <label for="surname">Surname:</label>
            <input name='surname' type="text">
            
            <label for="picture">Profile Picture:</label>
            <input name='picture' type="file">

            <label for="nickname">Email:</label>
            <input name='nickname' type="text">

            <label for="password">Password:</label>
            <input name='password' type="password">
            
            <button type="submit">Sing Up</button>
            @if(session('error')) 
                <p class='error'>{{session('error')}}</p>
            @endif
        </form>
    </main>
</body>
</html>