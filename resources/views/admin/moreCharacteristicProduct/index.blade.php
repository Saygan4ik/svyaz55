@extends('layouts.admin')

@section('content')

    <section id="base_characteristic">
        <h1>Дополнительные характеристики</h1>
        @if (Session::get('msg'))
            <div class="alert alert-info">
                <p>{{ Session::get('msg') }}</p>
            </div>
        @endif
        <a href="/moreCharacteristicProduct/create" class="btn btn-primary">Создать</a>
        @foreach($moreCharacteristicsProduct as $characteristic)
            <div class="base-characteristic-item">
                <div class="base-characteristic-item-data">
                    <p>Текст: {{ $characteristic->text }}</p>
                </div>
                <div class="btn-group">
                    <a href="moreCharacteristicProduct/{{ $characteristic->id }}/edit" class="btn btn-primary">Редактировать</a>
                    <a class="btn btn-warning" onclick="event.preventDefault();
                            if(confirm('Удаление характеристики: {{ $characteristic->text }}! Вы уверены?')) {
                            document.getElementById('delete-form-{{ $characteristic->id }}').submit(); };">
                        <form id="delete-form-{{ $characteristic->id }}" action="{{ action('MoreCharacteristicProductController@destroy', ['id' => $characteristic->id]) }}" method="POST">
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