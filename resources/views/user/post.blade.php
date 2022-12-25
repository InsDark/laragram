<?php use App\Http\Controllers\UserController;?>
<?php use Illuminate\Support\Facades\Storage; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../css/utils/normalize.css">
    <link rel="stylesheet" href="./../css/index.css">
    <title>Laragram - Post</title>
</head>
<body>
    @include('layout.header')
    <main id='post'>
        <div class="picture-container">
            <div class="maker">
                <h2>{{'@' . $photo->user->nickname}}</h2>
                <span>|</span>
                <span>{{$photo->user->name . ' ' . $photo->user->surname}}</span>
            </div>
            <img src="{{asset(Storage::url($photo->image_path))}}" alt="{{$photo->description}}">
            <div class="picture-details">
                    <p>{{$photo->description}}</p>
                    <div >
                        <span class='fa-regular fa-comment'> {{count($photo->comments)}}</span>
                        
                        <a href="{{action([UserController::class, 'like'], ['id' => $photo->id])}}">
                            <?php 
                                $user = new UserController();
                                $selfLike = $user->getSelfLike($photo->id);
                            ?>
                            @if($selfLike)
                                <span class='fa-solid fa-heart'></span>
                            @else
                                <span class='fa-regular fa-heart'></span>
                            @endif
                            {{count($photo->likes)}}</a>
                    </div>
                </div>
        </div>
        <div class="comments">
            @if (count($photo->comments) == 0) 
            <h2>This photo doesn't have comments</h2>
            @else
            <h2>Comments</h2>
            @endif
        </div>
    </main>
    <script src="https://kit.fontawesome.com/b8ffa0db99.js" crossorigin="anonymous"></script>

</body>
</html>