<?php use App\Http\Controllers\UserController ?>
<?php use Illuminate\Support\Facades\Storage; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/utils/normalize.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Laragram - Users</title>
</head>
<body>
    @include('layout.header')
    <main>
        <section id='people'>
            @if (count($users) == 0) 
            <h1>You are the only user in the platform</h1>
            @else 
            <h1>Current users in the platform</h1>
                @foreach ($users as $user)
                    <div class='user-container'>
                        <div class="avatar">

                            <img src="{{asset(Storage::url($user->image_path))}}" alt="user-avatar">
                        </div>
                        <div class='user-details'>
                            <a href="{{action([UserController::class, 'profile'], ['id' => $user->id])}}">{{'@' . $user->nickname}}</a>
                            <h2>{{$user->name . ' ' . $user->surname}} </h2>
                        </div>
                    </div>
                @endforeach
            @endif
        </section>
    </main>
</body>
</html>