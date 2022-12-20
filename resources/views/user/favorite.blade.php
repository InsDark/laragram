<?php use Illuminate\Support\Facades\Storage; ?>
<?php use App\Http\Controllers\UserController ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/utils/normalize.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Laragram - Favorites</title>
</head>
<body>
    @include('layout.header')
    <main id='favorites'>
        <h1>My favorite images</h1>
        <hr/>
        @foreach($favorites as $favorite)
        <div class = 'picture'>
                    <a href="">
                        <img src="{{
                            asset(Storage::url($favorite->image->image_path))
                        }}" alt="{{$favorite->image->name}}">
                    </a>
                    <div class='picture-details'>
                        <h3>{{$favorite->image->description}}</h3>
                        <span><i class="fa-solid fa-comment"></i> {{count($favorite->image->comments)}}</span>

                        <a href="{{action([UserController::class, 'like'], ['id' => $favorite->image->id])}}">
                                <i class="fa-regular fa-heart"></i> 
                            {{count($favorite->image->likes)}}
                        </a>
                    </div>
                </div>
        @endforeach
    </main>
</body>
</html>