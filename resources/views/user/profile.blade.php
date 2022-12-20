<?php use App\Http\Controllers\UserController; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/utils/normalize.css">
    <link rel="stylesheet" href="../css/index.css">
    <title>Laragram - Profile</title>
</head>
<body>
    @include('layout.header')
    <main id = 'profile'>
        <section >
            <div class = 'avatar'>
                <img src="{{asset($profile_path)}}" alt="user-avatar">
            </div>
            <div class="user-info">
                <h1>{{'@' . session('identity')->nickname}}</h1>
                <h2>{{session('identity')->name}} {{session('identity')->surname}}</h2>
            </div>
        </section>
        <hr/>
        <section>
            @if(count($images) > 0)
                @foreach ($images as $image) 
                <div class = 'picture'>
                    <a href="">
                        <img src="{{
                            asset(Storage::url($image->image_path))
                        }}" alt="{{$image->name}}">
                    </a>
                    <div class='picture-details'>
                        <h3>{{$image->description}}</h3>
                        <span><i class="fa-solid fa-comment"></i> {{count($image->comments)}}</span>

                        <a href="{{action([UserController::class, 'like'], ['id' => $image->id])}}">
                            @if($self_like)
                                <i class="fa-solid fa-heart"></i> 
                                @else
                                <i class="fa-regular fa-heart"></i> 
                            @endif
                            {{count($image->likes)}}
                        </a>
                    </div>
                </div>
                @endforeach
            @else 
                    @if ($user_id == session('identity')->id)
                        <h2>You not have photos to show</h2>
                    @else
                        <h2>This user does not have photos to show</h2>
                    @endif
            @endif  
        </section>
    </main>
    <script src="https://kit.fontawesome.com/b8ffa0db99.js" crossorigin="anonymous"></script>
</body>
</html>