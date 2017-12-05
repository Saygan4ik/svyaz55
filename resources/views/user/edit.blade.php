@extends('layouts.app')

@section('content')

    <div class="container">
        @if (Session::get('msg'))
            <div class="alert alert-info">
                <p>{{ Session::get('msg') }}</p>
            </div>
        @endif
        <h3>Мой профиль</h3>
        <div class="user-profile crop-image-class" id="user_profile">

            <!-- Current avatar -->
            <div class="user-avatar current-image">
                <img src="/imagecache?src={{ $user->avatar }}" alt="user avatar">
                <button type="button" class="btn btn-primary btn-block show-crop-modal">Загрузить</button>
                <button class="btn btn-warning" onclick="event.preventDefault();
                        if(confirm('Удалить аватар и установить стандартный?')) {
                        document.getElementById('delete-form-avatar').submit(); };">Удалить</button>
                <form id="delete-form-avatar" action="{{ action('UserController@deleteAvatar', ['id' => $user->id]) }}" method="POST">
                    <input name="_method" type="hidden" value="DELETE">
                    {{ csrf_field() }}
                </form>
            </div>

            <!-- Cropping modal -->
            <div class="modal fade" id="image-modal" aria-hidden="true" aria-labelledby="image-modal-label" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form class="image-form" action="{{ action('UserController@saveAvatar', ['id' => $user->id]) }}" enctype="multipart/form-data" method="POST">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="image-modal-label">Изменение аватара:</h4>
                            </div>
                            <div class="modal-body">
                                <div class="image-body">

                                    <!-- Upload image and data -->
                                    <div class="image-upload">
                                        <input type="hidden" class="image-src" name="image_src">
                                        <input type="hidden" class="image-data" name="image_data">
                                        <label for="imageInput">Аватар</label>
                                        <input type="file" class="image-input" id="imageInput" name="image_file">
                                    </div>

                                    <!-- Crop and preview -->
                                    <div class="image-wrapper"></div>

                                    <div class="row image-btns">
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary btn-block image-save">Сохранить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal -->



            <div class="user-data">
                <form action="{{ action('UserController@updateProfile', ['id' => $user->id]) }}" method="POST" class="">
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

@section('script')
    <script src="{{ asset('cropperJquery/dist/cropper.js') }}"></script>
    @include('cropImageScript')
@endsection