<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('#create_characteristic').click(function(e) {
            e.preventDefault();
            var url = $('#url-char').val();
            var name = $('#name-char').val();
            var slug = $('#slug-char').val();
            var unit = $('#unit-char').val();
            $.ajax({
                url: url,
                type: 'POST',
                data: {name : name, slug : slug, unit : unit},
                dataType: 'json',
                success: function(data) {
                    $('.characteristicProduct-inner').append('<div class="characteristicProduct-item">' +
                        '<label for="char_' + data["id"] + '">' + data["name"] + ', ' + data["unit"] + '</label>' +
                        '<input type="text" name="characteristicProduct[]" id="char_' + data["id"] + '" class="form-control">' +
                        '</div>');
                    $('#ModalAddNewCharacteristic').modal('hide');
                },
                error: function( xhr, status, errorThrown ) {
                    alert( "Ошибка сохранения!" );
                    console.log( "Error: " + errorThrown );
                    console.log( "Status: " + status );
                    console.dir( xhr );
                },
            });
        });

        $('#create_more_characteristic').click(function(e) {
            e.preventDefault();
            var url = $('#url-moreChar').val();
            var text = $('#text-char').val();
            $.ajax({
                url: url,
                type: 'POST',
                data: {text : text},
                dataType: 'json',
                success: function(data) {
                    $('.moreCharacteristicProduct-inner').append('<div class="moreCharacteristicProduct-item">' +
                        '<input type="checkbox" id="moreChar_' + data["id"] + '" name="moreCharacteristic[]" value="' + data["id"] + '" class="checkbox-button">' +
                        '<label for="moreChar_' + data["id"] + '">' + data["text"] + '</label>' +
                        '</div>');
                    $('#ModalAddNewMoreCharacteristic').modal('hide');
                },
                error: function( xhr, status, errorThrown ) {
                    alert( "Ошибка сохранения!" );
                    console.log( "Error: " + errorThrown );
                    console.log( "Status: " + status );
                    console.dir( xhr );
                },
            });
        });

        $('.characteristicProduct-btn').click(function (e) {
            e.preventDefault();
            $('.characteristicProduct').toggleClass('hidden');
        });

        $('.moreCharacteristicProduct-btn').click(function (e) {
            e.preventDefault();
            $('.moreCharacteristicProduct').toggleClass('hidden');
        });
    });
</script>