@extends('layouts.admin')

@section('content')
    <section id="product_create">
        <h1>Редактирование товара: {{ $product->name }}</h1>
        @if (Session::get('msg'))
            <div class="alert alert-info">
                <p>{{ Session::get('msg') }}</p>
            </div>
        @endif
        {{--product images--}}
        <div class="admin-product-images">
            @if (!$images->isEmpty())
                @foreach($images as $image)
                    <div id="admin_product_image_{{ $image->id }}" class="admin-product-images-item">
                        <img src="/imagecache?src={{ $image->image_name }}" alt="" class="
                            @if($image->isMain)
                                product-image-main
                            @endif
                                ">
                        <div class="btn-group-sm">
                            <div class="btn btn-success btn-save-main-image">
                                Сделать главным
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="image_id" value="{{ $image->id }}">
                                <input type="hidden" name="request_url" value="{{ action('ProductController@setMainImage') }}">
                            </div>
                            <button class="btn btn-warning" onclick="event.preventDefault();
                        if(confirm('Удалить изображение?')) {
                        document.getElementById('delete-product-{{ $image->id }}').submit(); };">Удалить</button>
                            <form id="delete-product-{{ $image->id }}" action="{{ action('ProductController@deleteImage', ['id' => $image->id]) }}" method="POST">
                                <input name="_method" type="hidden" value="DELETE">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Изображения отсутствуют!</p>
            @endif
        </div>
        <button class="btn btn-primary">Загрузить изображение</button>
        {{--end product images--}}

        <form action="{{ action('ProductController@update', ['slug' => $product->slug]) }}" method="POST" class="form-horizontal">
            <input type="hidden" name="_method" value="PATCH">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="brand">Фирма:</label>
                <input type="text" name="brand" id="brand" value="{{ $product->brand }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="name">Модель:</label>
                <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="slug">Слаг:</label>
                <input type="text" name="slug" id="slug" value="{{ $product->slug }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="price">Цена:</label>
                <input type="text" name="price" id="price" value="{{ $product->price }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="category">Категория товара:</label>
                <select name="category" id="category">
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}"
                                @if($category->slug == $product->category)
                                    selected
                                @endif>{{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="visible">Видимость для пользователей</label>
                <input type="checkbox" name="visible" id="visible" class="checkbox-button"
                       @if($product->visible)
                           checked
                       @endif
                >
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
                                <input type="text" name="characteristicProduct[{{ $characteristic->id }}]" id="char_{{ $characteristic->id }}" class="form-control"
                                       @foreach($product->characteristics as $prod_char)
                                               @if($characteristic->id == $prod_char->pivot['characteristic_id'])
                                                  value="{{ $prod_char->pivot['value'] }}"
                                               @endif
                                       @endforeach
                                >
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
                                <input type="checkbox" id="moreChar_{{ $moreCharacteristic->id }}" name="moreCharacteristic[]" value="{{ $moreCharacteristic->id }}" class="checkbox-button"
                                        @foreach($product->moreCharacteristics as $item)
                                            @if ($item->id == $moreCharacteristic->id)
                                                checked
                                            @endif
                                        @endforeach
                                >
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
                <button type="submit" class="btn btn-primary">Редактировать</button>
            </div>
        </form>
    </section>
@endsection

@section('script')
    @include('admin.product.scripts-product')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('.btn-save-main-image').click(function(e) {
                e.preventDefault();
                var productId = $(this).find("input[name = 'product_id']").val();
                var imageId = $(this).find("input[name = 'image_id']").val();
                var url = $(this).find("input[name = 'request_url']").val();

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: { product_id : productId, image_id : imageId},
                    dataType: 'json',
                    success: function(data) {
                        $('.admin-product-images-item').each(function() {
                            $(this).find('img').removeClass('product-image-main');
                            if ($(this).find("input[name = 'image_id']").val() == data['image_id']) {
                                $(this).find('img').addClass('product-image-main');
                            }
                        });
                    },
                    error: function(data) {
                        alert('Ошибка');
                    }
                });
            });
        });
    </script>
@endsection