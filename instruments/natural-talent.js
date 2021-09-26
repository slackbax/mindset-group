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
        url: 'instruments/ajax.insertTalent.php',
        type: 'post',
        dataType: 'json',
        beforeSubmit: validateForm,
        success: showResponse
    };

    $loader.css('display', 'none');

    $('.valor').change(function () {
        if ($(this).val() !== '') {
            if ($(this).val() >= 1 && $(this).val() <= 5) {
                const per = $(this).attr('id').split('_')[0];
                const asp = $(this).attr('id').split('_')[2];

                let total = 0;
                $('.' + per + '-' + asp).each(function () {
                    if ($(this).val() !== '' && !isNaN($(this).val()))
                        total += parseInt($(this).val());
                });
                const $inTotal = $('#' + per + '_' + asp);
                $inTotal.val(total);
            } else {
                swal("¡Error!", "El valor ingresado no corresponde a la escala definida para el instrumento. Recuerde que el valor no puede ser menor a 1 ni mayor a 5.", "error");
                $(this).val('');
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