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
                        document.location.replace('index.php?section=results&sbs=teamhealth');
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
        url: 'instruments/ajax.insertTeamHealth.php',
        type: 'post',
        dataType: 'json',
        beforeSubmit: validateForm,
        success: showResponse
    };

    $loader.css('display', 'none');

    $clear.click(function () {
        $('.form-group').removeClass('has-error has-success');
        $('.form-control-feedback').removeClass('fa-times fa-check');
    });

    $form.submit(function () {
        $(this).ajaxSubmit(options);
        return false;
    });
});