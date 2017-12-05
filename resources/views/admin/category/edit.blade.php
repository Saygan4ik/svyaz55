@extends('layouts.admin')

@section('content')
    <h1>Редактирование категории: {{ $category->name }}</h1>
    <form action="{{ action('CategoryController@update', ['slug' => $category->slug]) }}" method="POST" class="form-horizontal">
        <input name="_method" type="hidden" value="PATCH">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Название категории:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
        </div>
        <div class="form-group">
            <label for="slug">Имя ссылки (slug):</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ $category->slug }}">
        </div>
        <div class="form-group">
            <div class="">
                <label for="">Видимость категории для пользователей:</label>
                <div class="">
                    <input type="checkbox" id="isVisible" name="isVisible" class="checkbox-button"
                    @if($category->visible)
                        checked
                    @endif
                    >
                    <label for="isVisible">Вкл/Выкл</label>
                </div>
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