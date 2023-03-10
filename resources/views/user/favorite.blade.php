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
            <div class='picture-container'>
                <div class="maker">
                    <h2>{{'@' . $favorite->image->user->nickname}}</h2>
                    <span>|</span>
                    <span>{{$favorite->image->user->name . ' ' . $favorite->image->user->surname}}</span>
                </div>
                <a href="{{route('post', ['id' => $favorite->image->id])}}" class='picture'>
                    <img loading="lazy" src="{{asset(Storage::url($favorite->image->image_path))}}" alt="{{$favorite->description}}">
                </a>
                <div class="picture-details">
                    <p>{{$favorite->description}}</p>
                    <div >
                        <span class='fa-regular fa-comment'> {{count($favorite->image->comments)}}</span>
                        
                        <a href="{{action([UserController::class, 'like'], ['id' => $favorite->image->id])}}">
                            <?php 
                                $user = new UserController();
                                $selfLike = $user->getSelfLike($favorite->image->id);
                            ?>
                            @if($selfLike)
                                <span class='fa-solid fa-heart'></span>
                            @else
                                <span class='fa-regular fa-heart'></span>
                            @endif
                            {{count($favorite->image->likes)}}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </main>
    <script src="https://kit.fontawesome.com/b8ffa0db99.js" crossorigin="anonymous"></script>
</body>
</html>