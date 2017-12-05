@extends('layouts.admin')

@section('content')
    <section id="product_create">
        <h1>Создание товара</h1>
        <form action="{{ action('ProductController@store') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="brand">Фирма:</label>
                <input type="text" name="brand" id="brand" class="form-control">
            </div>
            <div class="form-group">
                <label for="name">Модель:</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="slug">Слаг:</label>
                <input type="text" name="slug" id="slug" class="form-control">
            </div>
            <div class="form-group">
                <label for="price">Цена:</label>
                <input type="text" name="price" id="price" class="form-control">
            </div>
            <div class="form-group">
                <label for="category">Категория товара:</label>
                <select name="category" id="category">
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="visible">Видимость для пользователей</label>
                <input type="checkbox" name="visible" id="visible" class="checkbox-button">
                <label for="visible">Вкл/Выкл</label>
            </div>
            <div class="form-group">
                <div class="characteristicProduct-btn btn btn-success">Основные характеристики товара:</div>
                <div class="characteristicProduct hidden">
                    <div class="characteristicProduct-inner">
                        @foreach($characteristics as $characteristic)
                            <div class="characteristicProduct-item">
                                <label for="char_{{ $characteristic->id }}">{{ $characteristic->name }}@if($characteristic->unit), {{ $characteristic->unit }}@endif
                                </label>
                                <input type="text" name="characteristicProduct[{{ $characteristic->id }}]" id="char_{{ $characteristic->id }}" class="form-control">
                            </div>
                        @endforeach
                    </div>
                    <br>
                    <!-- Button trigger modal -->
                    <div class="btn btn-primary" data-toggle="modal" data-target="#ModalAddNewCharacteristic">
                        Добавить новую характеристику
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="ModalAddNewCharacteristic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Создание новой характеристики</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="url-char" value="{{ action('CharacteristicProductController@store') }}">
                                    <div class="form-group">
                                        <label for="name-char">Название:</label>
                                        <input type="text" class="form-control" id="name-char" name="" placeholder="Обязательное поле">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug-char">Слаг:</label>
                                        <input type="text" class="form-control" id="slug-char" name="" placeholder="Обязательное поле. Латинские символы">
                                    </div>
                                    <div class="form-group">
                                        <label for="unit-char">Единица измерения:</label>
                                        <input type="text" class="form-control" id="unit-char" name="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                    <button type="button" class="btn btn-primary" id="create_characteristic">Создать</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="moreCharacteristicProduct-btn btn btn-success">Дополнительные характеристики товара:</div>
                <div class="moreCharacteristicProduct hidden">
                    <div class="moreCharacteristicProduct-inner">
                        @foreach($moreCharacteristics as $moreCharacteristic)
                            <div class="moreCharacteristicProduct-item">
                                <input type="checkbox" id="moreChar_{{ $moreCharacteristic->id }}" name="moreCharacteristic[]" value="{{ $moreCharacteristic->id }}" class="checkbox-button">
                                <label for="moreChar_{{ $moreCharacteristic->id }}">{{ $moreCharacteristic->text }}</label>
                            </div>
                        @endforeach
                    </div>
                    <br>
                    <!-- Button trigger modal -->
                    <div class="btn btn-primary" data-toggle="modal" data-target="#ModalAddNewMoreCharacteristic">
                        Добавить новую характеристику
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="ModalAddNewMoreCharacteristic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Создание новой характеристики</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="url-moreChar" value="{{ action('MoreCharacteristicProductController@store') }}">
                                    <div class="form-group">
                                        <label for="name-char">Текст:</label>
                                        <input type="text" class="form-control" id="text-char" name="" placeholder="Обязательное поле">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                    <button type="button" class="btn btn-primary" id="create_more_characteristic">Создать</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Создать</button>
            </div>
        </form>
    </section>
@endsection

@section('script')
    @include('admin.product.scripts-product')
@endsection