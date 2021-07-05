$(document).ready(function () {

    function validateForm() {
        $('#submitLoader').css('display', 'inline-block');
        return true;
    }

    function showResponse(response) {
        $('#submitLoader').css('display', 'none');

        if (response.type) {
            new Noty({
                text: '<b>¡Éxito!</b><br> El usuario ha sido guardado correctamente.',
                type: 'success'
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
        url: 'admin/users/ajax.editUser.php',
        type: 'post',
        dataType: 'json',
        beforeSubmit: validateForm,
        success: showResponse
    };

    $('#submitLoader').css('display', 'none');

    $('#iNrut').blur(function () {
        $('#grut').removeClass('has-success has-error');
        $('#iconrut').removeClass('fa-times fa-check');

        if ($.trim($(this).val()) !== '') {
            $.ajax({
                url: 'admin/users/ajax.getUser.php',
                type: 'post',
                dataType: 'json',
                data: {rut: $(this).val()}
            }).done(function (d) {
                if (d.us_id !== null) {
                    swal('¡Error!', 'El RUT ingresado ya se encuentra registrado.', 'error');
                    $('#iNrut').val('');
                    $('#grut').removeClass('has-success has-error').addClass('has-error');
                    $('#iconrut').removeClass('fa-times fa-check').addClass('fa-times');
                }
            });
        }
    }).Rut({
        on_error: function () {
            swal("Error!", "El RUT ingresado no es válido.", "error");
            $('#iNrut').val('');
            $('#grut').removeClass('has-success has-error').addClass('has-error');
            $('#iconrut').removeClass('fa-times fa-check').addClass('fa-times');
        },
        on_success: function () {
            $('#grut').addClass('has-success');
            $('#iconrut').addClass('fa-check');
        },
        format_on: 'keyup'
    });

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

    $('#iNname, #iNlastnamep, #iNlastnamem, #iNpassword, #iNphone').change(function () {
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
        $('#grut, #gname, #glastnamep, #glastnamem, #gemail, #gusername, #gpassword, #gphone').removeClass('has-error has-success');
        $('#iconrut, #iconname, #iconlastnamep, #iconlastnamem, #iconEmail, #iconphone, #iconUsername').removeClass('fa-times fa-check');
    });

    $('#formNewUser').submit(function () {
        $(this).ajaxSubmit(options);
        return false;
    });
});