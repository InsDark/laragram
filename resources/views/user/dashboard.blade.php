<?php use Illuminate\Support\Facades\Storage; ?>
<?php use App\Http\Controllers\UserController; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/utils/normalize.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Laragram - Dashboard</title>
</head>
<body>
    @include('layout.header')
    <main id='dashboard'>
        @foreach($images as $image)
            <div class='picture-container'>
                <div class="maker">
                    <h2>{{'@' . $image->user->nickname}}</h2>
                    <span>|</span>
                    <span>{{$image->user->name . ' ' . $image->user->surname}}</span>
                </div>
                <a href="{{route('post', ['id' => $image->id])}}" class='picture'>
                    <img loading="lazy" src="{{asset(Storage::url($image->image_path))}}" alt="{{$image->description}}">
                </a>
                <div class="picture-details">
                    <p>{{$image->description}}</p>
                    <div >
                        <span class='fa-regular fa-comment'> {{count($image->comments)}}</span>
                        
                        <a href="{{action([UserController::class, 'like'], ['id' => $image->id])}}">
                            <?php 
                                $user = new UserController();
                                $selfLike = $user->getSelfLike($image->id);
                            ?>
                            @if($selfLike)
                                <span class='fa-solid fa-heart'></span>
                            @else
                                <span class='fa-regular fa-heart'></span>
                            @endif
                            {{count($image->likes)}}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </main>
    <script src="https://kit.fontawesome.com/b8ffa0db99.js" crossorigin="anonymous"></script>
</body>
</html>