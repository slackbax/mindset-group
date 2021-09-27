$(document).ready(function () {
    const $loader = $('#submitLoader'), $clear = $('#btnClear'), $form = $('#formNewTest');

    function validateForm() {
        $loader.css('display', 'inline-block');
        return true;
    }

    function showResponse(response) {
        $loader.css('display', 'none');

        if (response.type) {
            new Noty({
                text: '<b>¡Éxito!</b><br> Las respuestas han sido guardadas correctamente.',
                type: 'success',
                callbacks: {
                    afterClose: function () {
                        location.reload();
                        return false;
                    }
                }
            }).show();

            $clear.click();
            $form.clearForm();
            $('.minimal').iCheck('disable');
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
        url: 'instruments/ajax.insertCompetitive.php',
        type: 'post',
        dataType: 'json',
        beforeSubmit: validateForm,
        success: showResponse
    };

    $loader.css('display', 'none');

    $('.valor').change(function () {
        if ($(this).val() !== '') {
            const per = $(this).attr('id').split('_')[0];
            const asp = $(this).attr('id').split('_')[2];
            let inputAnswered = 0, total = 0, lastId = '';
            $('.' + per + '-' + asp).each(function () {
                lastId = $(this).attr('id');
                if ($(this).val() !== '' && !isNaN($(this).val())) {
                    total += parseInt($(this).val());
                    inputAnswered++;
                }
            });
            const $inTotal = $('#' + per + '_' + asp);

            if (total > 100) {
                swal("¡Error!", "Los valores ingresados suman más de 100 puntos para el perfil. Recuerde que la suma no debe superar los 100 puntos.", "error");
                $(this).val('');
            } else {
                $inTotal.val(total);
                if (total === 100)
                    $inTotal.addClass('text-green');
                else {
                    $inTotal.removeClass('text-green');
                    if (inputAnswered === 4) {
                        swal("¡Error!", "Los valores ingresados suman menos de 100 puntos para el perfil. Recuerde que la suma no debe ser inferior a los 100 puntos.", "error");
                        $('#' + lastId).val('');
                        total = 0;
                        $('.' + per + '-' + asp).each(function () {
                            if ($(this).val() !== '' && !isNaN($(this).val())) {
                                total += parseInt($(this).val());
                                inputAnswered++;
                            }
                        });
                        $inTotal.val(total);
                    }
                }
            }
        }
    })

    $clear.click(function () {
        $('.form-group').removeClass('has-error has-success');
        $('.form-control-feedback').removeClass('fa-times fa-check');

        $('.minimal').iCheck('uncheck');
    });

    $form.submit(function () {
        $(this).ajaxSubmit(options);
        return false;
    });
});