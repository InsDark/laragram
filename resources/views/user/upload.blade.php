<?php use App\Http\Controllers\UserController ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/utils/normalize.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Laragram - Upload</title>
</head>
<body>
    @include('layout.header')
    <main id="uploader">
        <form action="{{action([UserController::class , 'upload'])}}" method='post' enctype="multipart/form-data">
            {{csrf_field()}}
            <h1>Post a photo</h1>
            <label for="image">Image:</label>
            <input name='image' type="file">
            
            <label for="description">Description:</label>
            <input name='description' type="text">

            <input type="submit" value='Post Image'>
        </form>
    </main>
</body>
</html>