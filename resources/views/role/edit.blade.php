@extends('layouts/admin')

@section('content')
    <h1>Создание новой роли</h1>
    <form action="{{ action('RoleController@update', ['slug' => $role->slug]) }}" method="POST" class="form-horizontal">
        <input name="_method" type="hidden" value="PATCH">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Название роли:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}">
        </div>
        <div class="form-group">
            <label for="slug">Имя ссылки (slug):</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ $role->slug }}">
        </div>
        <div class="form-group">
            <div class="permissions">
                <label for="">Выберите права для роли:</label>
                @foreach($permissions as $permission)
                    <div class="permission-item">
                        <input type="checkbox" id="{{ $permission->slug }}" name="permissions[]" value="{{ $permission->id }}" class="permission-checkbox"

                        @foreach($role->permissions as $item)
                            @if ($item->slug == $permission->slug)
                                checked
                            @endif
                        @endforeach

                        >
                        <label for="{{ $permission->slug }}">{{ $permission->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        @include('errors/validation')

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Редактировать
            </button>
        </div>
    </form>
    
@endsection