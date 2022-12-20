<?php use App\Http\Controllers\UserController ?>
<header>
    @if(session('identity'))
    <h2><a href="{{route('dashboard')}}">Laragram</a></h2>
    @else
    <h2>Laragram</h2>
    @endif
    <section>
    @if(session('identity'))
        <a href="{{action([UserController::class, 'profile'], ['id' => session('identity')->id])}}">Profile</a>
        <a href="{{route('upload')}}">Post Image</a>
        <a href="{{action([UserController::class, 'favorites'])}}">Favorites</a>
        <a href="{{route('users')}}">People</a>
        <a href="{{action([UserController::class, 'close'])}}">Log Out</a>
        @else 
        <a href="login">Log In</a>
        <a href="register">Sing Up</a>
        @endif
    </section>
</header>