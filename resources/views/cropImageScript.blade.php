<script>

    (function (factory) {
        if (typeof define === 'function' && define.amd) {
            // AMD. Register as anonymous module.
            define(['jquery'], factory);
        } else if (typeof exports === 'object') {
            // Node / CommonJS
            factory(require('jquery'));
        } else {
            // Browser globals.
            factory(jQuery);
        }
    })(function ($) {

        'use strict';

        var console = window.console || { log: function () {} };

        function CropAvatar($element) {
            this.$container = $element;

            this.$imageView = this.$container.find('.current-image');
            this.$btnShowModal = this.$imageView.find('.show-crop-modal');
            this.$curImage = this.$imageView.find('img');
            this.$imageModal = this.$container.find('#image-modal');

            this.$imageForm = this.$imageModal.find('.image-form');
            this.$imageUpload = this.$imageForm.find('.image-upload');
            this.$imageSrc = this.$imageForm.find('.image-src');
            this.$imageData = this.$imageForm.find('.image-data');
            this.$imageInput = this.$imageForm.find('.image-input');
            this.$imageSave = this.$imageForm.find('.image-save');
            this.$imageBtns = this.$imageForm.find('.image-btns');

            this.$imageWrapper = this.$imageModal.find('.image-wrapper');

            this.init();
        }

        CropAvatar.prototype = {
            constructor: CropAvatar,

            support: {
                fileList: !!$('<input type="file">').prop('files'),
                blobURLs: !!window.URL && URL.createObjectURL,
                formData: !!window.FormData
            },

            init: function () {
                this.support.datauri = this.support.fileList && this.support.blobURLs;
                this.initModal();
                this.addListener();
            },

            addListener: function () {
                this.$btnShowModal.on('click', $.proxy(this.click, this));
                this.$imageInput.on('change', $.proxy(this.change, this));
                this.$imageForm.on('submit', $.proxy(this.submit, this));
            },

            initModal: function () {
                this.$imageModal.modal({
                    show: false
                });
            },

            click: function () {
                this.$imageModal.modal('show');
            },

            change: function () {
                var files;
                var file;

                if (this.support.datauri) {
                    files = this.$imageInput.prop('files');

                    if (files.length > 0) {
                        file = files[0];

                        if (this.isImageFile(file)) {
                            if (this.url) {
                                URL.revokeObjectURL(this.url); // Revoke the old one
                            }

                            this.url = URL.createObjectURL(file);
                            this.startCropper();
                        }
                    }
                } else {
                    file = this.$imageInput.val();

                    if (this.isImageFile(file)) {
                        this.syncUpload();
                    }
                }
            },

            submit: function () {
                if (!this.$imageSrc.val() && !this.$imageInput.val()) {
                    return false;
                }

                if (this.support.formData) {
                    this.ajaxUpload();
                    return false;
                }
            },

            isImageFile: function (file) {
                if (file.type) {
                    return /^image\/\w+$/.test(file.type);
                } else {
                    return /\.(jpg|jpeg|png)$/.test(file);
                }
            },

            startCropper: function () {
                var _this = this;

                if (this.active) {
                    this.$img.cropper('replace', this.url);
                } else {
                    this.$img = $('<img src="' + this.url + '">');
                    this.$imageWrapper.empty().html(this.$img);
                    this.$img.cropper({
                        aspectRatio: 1 / 1,
                        minCropBoxWidth: 100,
                        minCropBoxHeight: 100,
                        crop: function (e) {
                            var json = [
                                '{"x":' + e.x,
                                '"y":' + e.y,
                                '"height":' + e.height,
                                '"width":' + e.width + '}'
                            ].join();

                            _this.$imageData.val(json);
                        }
                    });

                    this.active = true;
                }

                this.$imageModal.one('hidden.bs.modal', function () {
                    _this.stopCropper();
                });
            },

            stopCropper: function () {
                if (this.active) {
                    this.$img.cropper('destroy');
                    this.$img.remove();
                    this.active = false;
                }
            },

            ajaxUpload: function () {
                var url = this.$imageForm.attr('action');
                var data = new FormData(this.$imageForm[0]);
                var _this = this;

                $.ajax({
                    type: 'post',
                    url: url,
                    data: data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function () {
                        _this.cropDone();
                    },

                    error: function () {
                        _this.submitFail('Ошибка загрузки');
                    }
                });
            },

            syncUpload: function () {
                this.$imageSave.click();
            },

            submitFail: function (msg) {
                this.alert(msg);
            },

            cropDone: function () {
                this.$imageForm.get(0).reset();
                this.$curImage.attr('src', this.url);
                this.stopCropper();
                this.$imageModal.modal('hide');
                location.reload();
            },

            alert: function (msg) {
                var $alert = [
                    '<div class="alert alert-danger avatar-alert alert-dismissable">',
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>',
                    msg,
                    '</div>'
                ].join('');

                this.$imageUpload.after($alert);
            }
        };

        $(function () {
            return new CropAvatar($('.crop-image-class'));
        });

    });
</script>