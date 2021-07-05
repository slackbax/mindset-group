$(document).ready(function () {

    function validateForm() {
        $('#submitLoader').css('display', 'inline-block');
        return true;
    }

    function showResponse(response) {
        $('#submitLoader').css('display', 'none');

        if (response.type) {
            new Noty({
                text: '<b>¡Éxito!</b><br> El usuario ha sido guardado correctamente. Actualizando sesión...',
                type: 'success',
                callbacks: {
                    afterClose: function () {
                        location.reload();
                    }
                }
            }).show();

            $('#btnClear').click();
            $('input:file').MultiFile('reset');
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
        url: 'admin/users/ajax.editProfile.php',
        type: 'post',
        dataType: 'json',
        beforeSubmit: validateForm,
        success: showResponse
    };

    $('#submitLoader').css('display', 'none');

    $('#iNemail').change(function () {
        $('#gemail').removeClass('has-error has-success');
        $('#iconEmail').removeClass('fa-times fa-check');

        var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

        if ($(this).val() !== '') {
            if (!email_reg.test($.trim($(this).val()))) {
                $(this).val('');
                $('#gemail').addClass('has-error');
                $('#iconEmail').addClass('fa-times');

                swal({
                    title: "Error!",
                    text: "El correo ingresado no es correcto.",
                    type: "error"
                });
            } else {
                $('#gemail').addClass('has-success');
                $('#iconEmail').addClass('fa-check');
            }
        }
    });

    $('#iNname, #iNlastnamep, #iNlastnamem').change(function () {
        var idn = $(this).attr('id').split('N');

        if ($.trim($(this).val()) !== '') {
            $('#g' + idn[1]).removeClass('has-error').addClass('has-success');
            $('#icon' + idn[1]).removeClass('fa-times').addClass('fa-check');
        } else {
            $('#g' + idn[1]).removeClass('has-success');
            $('#icon' + idn[1]).removeClass('fa-check');
        }
    });

    $('#btnClear').click(function () {
        $('#gname, #glastnamep, #glastnamem, #gemail').removeClass('has-error has-success');
        $('#iconname, #iconlastnamep, #iconlastnamem, #iconEmail').removeClass('fa-times fa-check');
    });

    $('#formNewUser').submit(function () {
        $(this).ajaxSubmit(options);
        return false;
    });
});