@extends('layouts/admin')

@section('content')
    <section id="section_categories">
        <h1>Категории товаров</h1>
        @if (Session::get('msg'))
            <div class="alert alert-info">
                <p>{{ Session::get('msg') }}</p>
            </div>
        @endif
        <a href="/category/create" class="btn btn-primary">Создать новую категорию</a>
        @foreach($categories as $category)
            <div class="categories-item">
                <h3>{{ $category->name }}</h3>
                <p>Видимость:
                @if($category->visible)
                    Вкл
                @else
                    Выкл
                @endif
                </p>
                <a href="#">Товаров: #</a>
                <div class="edit-button">
                    <a href="/category/{{ $category->slug }}/edit" class="fa fa-pencil-square-o"></a>
                </div>
                <div class="delete-button" onclick="event.preventDefault();
                        if(confirm('Удаление категории: {{ $category->name }}! Вы уверены?')) {
                        document.getElementById('delete-form-{{ $category->id }}').submit(); };">
                    <form id="delete-form-{{ $category->id }}" action="{{ action('CategoryController@destroy', ['id' => $category->id]) }}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        {{ csrf_field() }}
                    </form>
                    <i class="fa fa-trash-o"></i>
                </div>
            </div>
        @endforeach
    </section>
@endsection