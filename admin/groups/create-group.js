$(document).ready(function () {
    const $submitLoader = $('#submitLoader'), $usuario = $('#iNusuario'), $div_users = $('#divUsers-inner'), $clear = $('#btnClear'), $form = $('#formNewGroup');

    function validateForm() {
        $submitLoader.css('display', 'inline-block');
        let validate = true;

        if (n_users === 0) {
            swal('¡Error!', 'El grupo debe tener asignado al menos un usuario.', 'error');
            validate = false;
        }

        if (validate) {
            $submitLoader.css('display', 'inline-block');
            return true;
        } else {
            new Noty({
                text: 'Error al registrar grupo.<br>Por favor, complete los campos requeridos.',
                type: 'error'
            }).show();

            $submitLoader.css('display', 'none');
            return false;
        }
    }

    function showResponse(response) {
        $submitLoader.css('display', 'none');

        if (response.type) {
            new Noty({
                text: '<b>¡Éxito!</b><br> El grupo ha sido guardado correctamente.',
                type: 'success'
            }).show();

            $clear.click();
            $div_users.html('<div class="row"><div class="form-group col-sm-12"><p class="form-control-static"><em>No se han asignado usuarios al grupo.</em></p></div></div>');
            $form.clearForm();

            ArrayUsers = [];
            n_users = 0;
            d_usr = 0;
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

    const options = {
        url: 'admin/groups/ajax.insertGroup.php',
        type: 'post',
        dataType: 'json',
        beforeSubmit: validateForm,
        success: showResponse
    };
    let ArrayUsers = [], n_users = 0, d_usr = 0;

    $submitLoader.css('display', 'none');

    $('#iNname').change(function () {
        $('#gname').removeClass('has-error has-success');
        $('#iconname').removeClass('fa-times fa-check');

        if ($(this).val() !== '') {
            $.ajax({
                type: 'POST',
                url: 'admin/groups/ajax.existGroup.php',
                dataType: 'json',
                data: {name: $(this).val()}
            }).done(function (r) {
                if (r.gr_id !== null) {
                    $('#gname').addClass('has-error');
                    $('#iconname').addClass('fa-times');
                    $('#iNname').val('');

                    swal({
                        title: "¡Error!",
                        text: "El nombre de grupo elegido ya se encuentra registrado.",
                        type: "error"
                    });
                } else {
                    $('#gname').addClass('has-success');
                    $('#iconname').addClass('fa-check');
                }
            });
        }
    });

    $('#btn-add-user').click(function () {
        const usText = $('#iNusuario :selected').text(), usVal = $usuario.val();

        if ($.trim(usVal) !== '') {
            let chk = false;

            $(ArrayUsers).each(function (index) {
                if (ArrayUsers[index] === usVal) chk = true;
            });

            if (!chk) {
                ArrayUsers.push(usVal);

                const $row = $('<div>');
                $row.attr('id', 'row' + n_users).addClass('row');

                const $pv = $('<div>'), $dl = $('<div>');
                $pv.addClass('form-group col-xs-10 col-lg-11');
                $dl.addClass('form-group col-xs-2 col-lg-1 text-center');
                $row.append('<input type="hidden" name="ius[]" id="iNus_' + n_users + '" value="' + usVal + '">');

                const $namePv = $('<p>');
                $namePv.addClass('form-control-static').text(usText);
                $pv.append($namePv);

                $dl.append('<button type="button" class="btn btn-xs btn-danger btnDel" name="btn_' + n_users + '" id="btndel_' + n_users + '"><i class="fa fa-close"></i></button>');
                $row.append($pv).append($dl);

                $('#gusuario').removeClass('has-success');
                $usuario.val('').change();
                if (n_users === 0) $div_users.html('');
                $div_users.append($row);
                $('#divTechs').css('display', 'block');
                n_users++;
                d_usr++;
                $('#iNnuser').val(d_usr);
            } else {
                swal("Error", "El usuario ya se encuentra agregado al grupo.", "error");
                $('#gusuario').removeClass('has-success');
                $usuario.val('');
            }
        }
    });

    $('#divUsers').on('click', '.btnDel', function () {
        const idn = $(this).attr('id').split('_').pop();
        const valDel = $('#iNus_' + idn).val();

        $(ArrayUsers).each(function (index) {
            if (ArrayUsers[index] === valDel)
                ArrayUsers.splice(index, 1);
        });

        $('#row' + idn).remove();
        d_usr--;

        if (d_usr === 0) {
            n_users = 0;
            $div_users.html('<div class="row"><div class="form-group col-xs-12"><p class="form-control-static"><em>No se han agregado usuarios al grupo.</em></p></div></div>');
        }

        $('#iNnuser').val(d_usr);
    });

    $('.form-control').change(function () {
        const idn = $(this).attr('id').split('N').pop();

        if ($.trim($(this).val()) !== '') {
            if ($(this).attr('type') === 'text')
                $(this).val($(this).val().replace(/\s+/g,' ').trim().toUpperCase());

            $('#g' + idn).removeClass('has-error').addClass('has-success');
            $('#icon' + idn).removeClass('fa-times').addClass('fa-check');
        } else {
            $('#g' + idn).removeClass('has-success');
            $('#icon' + idn).removeClass('fa-check');
        }
    });

    $clear.click(function () {
        $('.form-group').removeClass('has-error has-success');
        $('.form-control-feedback').removeClass('fa-times fa-check');
    });

    $form.submit(function () {
        $(this).ajaxSubmit(options);
        return false;
    });
});