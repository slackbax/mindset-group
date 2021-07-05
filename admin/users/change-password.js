$(document).ready(function () {

    function validateForm() {
        $('#submitLoader').css('display', 'inline-block');
        var _pass = true;

        $('.pincode-input-text').each(function () {
            if ($(this).val() === '') {
                $('#submitLoader').css('display', 'none');
                $('#goldpass, #gnewpass, #gcnpass').removeClass('has-success').addClass('has-error');
                _pass = false;

                swal({
                    title: "Error!",
                    text: "Debes ingresar todos los campos de contraseña para cambiarla.",
                    type: "error"
                });
            }
        });

        return _pass;
    }

    function showResponse(response) {
        $('#submitLoader').css('display', 'none');

        if (response.type) {
            new Noty({
                text: '<b>¡Éxito!</b><br>Las contraseñas han sido guardadas correctamente.<br>Volviendo a la pantalla de inicio...',
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
            if (response.code === 0) {
                new Noty({
                    text: '<b>¡Error!</b><br>' + response.msg,
                    type: 'error'
                }).show();
            } else if (response.code === 1) {
                new Noty({
                    text: response.msg,
                    type: 'error',
                    callbacks: {
                        afterClose: function () {
                            document.location.replace('index.php');
                        }
                    }
                }).show();
            }
        }
    }

    var options = {
        url: 'admin/users/ajax.editPassword.php',
        type: 'post',
        dataType: 'json',
        beforeSubmit: validateForm,
        success: showResponse
    };

    $('#iNoldpass').change(function () {
        $('#goldpass').removeClass('has-error').removeClass('has-success');
        $('#iconoldpass').removeClass('fa-times').removeClass('fa-check');

        if ($.trim($(this).val()) !== '')
            $.ajax({
                type: 'POST',
                url: 'admin/users/ajax.checkPass.php',
                dataType: 'json',
                data: { id: $('#uid').val(), pass: $('#iNoldpass').val() }
            }).done(function (r) {
                if (!r.msg) {
                    $('#goldpass').addClass('has-error');
                    $('#iconoldpass').addClass('fa-times');
                    $('#iNoldpass').val('');

                    swal("Error!", "La contraseña ingresada no es correcta.", "error");
                } else {
                    $('#goldpass').addClass('has-success');
                    $('#iconoldpass').addClass('fa-check');
                }
            });
    });

    $('#iNnewpass').change(function () {
        if ($.trim($(this).val()) !== '' && $.trim($('#iNcnpass').val()) !== '') {
            if ($(this).val() !== $('#iNcnpass').val()) {
                swal("Error!", "Las contraseñas ingresadas no coinciden.", "error");

                $('#gnewpass, #gcnpass').removeClass('has-success').addClass('has-error');
                $('#iconnewpass, #iconcnpass').removeClass('fa-check').addClass('fa-times');
                $('#iNcnpass').val('');
            } else {
                $('#gnewpass, #gcnpass').removeClass('has-error').addClass('has-success');
                $('#iconnewpass, #iconcnpass').removeClass('fa-times').addClass('fa-check');
            }
        }
    });

    $('#iNcnpass').change(function () {
        if ($.trim($(this).val()) !== '' && $.trim($('#iNnewpass').val()) !== '') {
            if ($(this).val() !== $('#iNnewpass').val()) {
                swal("Error!", "Las contraseñas ingresadas no coinciden.", "error");

                $('#gnewpass, #gcnpass').removeClass('has-success').addClass('has-error');
                $('#iconnewpass, #iconcnpass').removeClass('fa-check').addClass('fa-times');
                $('#iNcnpass').val('');
            } else {
                $('#gnewpass, #gcnpass').removeClass('has-error').addClass('has-success');
                $('#iconnewpass, #iconcnpass').removeClass('fa-times').addClass('fa-check');
            }
        }
    });

    $('#submitLoader').css('display', 'none');

    $('#btnClear').click(function () {
        $('#goldpass, #gnewpass, #gcnpass').removeClass('has-error').removeClass('has-success');
    });

    $('#formChangePass').submit(function () {
        $(this).ajaxSubmit(options);
        return false;
    });
});