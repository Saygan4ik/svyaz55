@extends('layouts.admin')

@section('content')

    <div class="container">
        @if (Session::get('msg'))
            <div class="alert alert-info">
                <p>{{ Session::get('msg') }}</p>
            </div>
        @endif
        <h3>Профиль: {{ $user->name }}</h3>
        <div class="user-profile crop-image-class" id="user_profile">

            <!-- Current avatar -->
            <div class="user-avatar current-image">
                <img src="/imagecache?src={{ $user->avatar }}" alt="user avatar">
                <button class="btn btn-warning" onclick="event.preventDefault();
                        if(confirm('Удалить аватар и установить стандартный?')) {
                        document.getElementById('delete-form-avatar').submit(); };">Удалить</button>
                <form id="delete-form-avatar" action="{{ action('UserController@deleteAvatar', ['id' => $user->id]) }}" method="POST">
                    <input name="_method" type="hidden" value="DELETE">
                    {{ csrf_field() }}
                </form>
            </div>

            <div class="user-data">
                <form action="{{ action('UserController@update', ['id' => $user->id]) }}" method="POST" class="">
                    <input name="_method" type="hidden" value="PATCH">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Редактировать</button>
                    </div>
                    @include('errors.validation')
                </form>
            </div>
        </div>
    </div>

@endsection