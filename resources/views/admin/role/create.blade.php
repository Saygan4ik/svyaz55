@extends('layouts/admin')

@section('content')
    <h1>Создание новой роли</h1>
    <form action="{{ action('RoleController@store') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Название роли:</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="slug">Имя ссылки (slug):</label>
            <input type="text" name="slug" id="slug" class="form-control">
        </div>
        <div class="form-group">
            <div class="permissions">
                <label for="">Выберите права для новой роли:</label>
                @foreach($permissions as $permission)
                    <div class="permission-item">
                        <input type="checkbox" id="{{ $permission->slug }}" name="permissions[]" value="{{ $permission->id }}" class="checkbox-button">
                        <label for="{{ $permission->slug }}">{{ $permission->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        @include('errors/validation')

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Создать
            </button>
        </div>
    </form>
@endsection