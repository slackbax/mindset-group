$(document).ready(function () {

    function validateForm() {
        $('#submitLoader').css('display', 'inline-block');
        return true;
    }

    function showResponse(response) {
        $('#submitLoader').css('display', 'none');

        if (response.type) {
            new Noty({
                text: '<b>¡Éxito!</b><br>La nueva contraseña ha sido enviada a su correo. Volviendo a la pantalla de inicio...',
                type: 'success',
                callbacks: {
                    afterClose: function () {
                        location.href = 'index.php';
                    }
                }
            }).show();

            $('#btnClear').click();
            $('#formChangePass').clearForm();
        } else {
            new Noty({
                text: '<b>¡Error!</b><br>' + response.msg,
                type: 'error'
            }).show();

            $('#iNusername').val('');
            $('#gusername').removeClass('has-success');
            $('#iconusername').removeClass('fa-check');
        }
    }

    var options = {
        url: 'admin/users/ajax.retrievePassword.php',
        type: 'post',
        dataType: 'json',
        beforeSubmit: validateForm,
        success: showResponse
    };

    $('#submitLoader').css('display', 'none');

    $('#iNusername').change(function () {
        if ($(this).val() !== '') {
            $('#gusername').addClass('has-success');
            $('#iconusername').addClass('fa-check');
        } else {
            $('#gusername').removeClass('has-success');
            $('#iconusername').removeClass('fa-check');
        }
    });

    $('#btnClear').click(function () {
        $('#gusername').removeClass('has-error has-success');
        $('#iconusername').removeClass('fa-times fa-check');
    });

    $('#formChangePass').submit(function () {
        $(this).ajaxSubmit(options);
        return false;
    });
});