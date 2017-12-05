@extends('layouts.admin')

@section('content')

    <section id="base_characteristic">
        <h1>Основные характеристики</h1>
        @if (Session::get('msg'))
            <div class="alert alert-info">
                <p>{{ Session::get('msg') }}</p>
            </div>
        @endif
        <a href="/characteristicProduct/create" class="btn btn-primary">Создать</a>
        @foreach($characteristicsProduct as $characteristic)
            <div class="base-characteristic-item">
                <div class="base-characteristic-item-data">
                    <p>Название: {{ $characteristic->name }}</p>
                    <p>Слаг: {{ $characteristic->slug }}</p>
                    <p>Единица измерения: {{ $characteristic->unit }}</p>
                </div>
                <div class="btn-group">
                    <a href="characteristicProduct/{{ $characteristic->slug }}/edit" class="btn btn-primary">Редактировать</a>
                    <a class="btn btn-warning" onclick="event.preventDefault();
                            if(confirm('Удаление характеристики: {{ $characteristic->name }}! Вы уверены?')) {
                            document.getElementById('delete-form-{{ $characteristic->id }}').submit(); };">
                        <form id="delete-form-{{ $characteristic->id }}" action="{{ action('CharacteristicProductController@destroy', ['id' => $characteristic->id]) }}" method="POST">
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                        </form>
                        Удалить
                    </a>
                </div>
            </div>
        @endforeach
    </section>

@endsection