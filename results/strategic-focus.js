$(document).ready(function () {
    $result = $('#divResult');
    $('#submitLoaderSearch').css('display', 'none');

    $('#btnsearch').click(function () {
        $result.html('');

        $.ajax({
            type: 'POST',
            url: 'results/ajax.getStrategicResultsByUser.php',
            dataType: 'json',
            data: {user: $('#iNuser').val(), test: 6}
        }).done(function (r) {
            if (r[0].text !== '') {
                $result.append('<h4 style="margin-bottom: 20px">Resultados de instrumento</h4>')
                $.each(r, function (i, v) {
                    $result.append('<p class="text-bold">' + v.pregunta + '</p>');
                    $result.append('<p>' + v.text + '</p>');
                    $result.append('<p class="text-center text-bold text-white" style="font-size: 20px; width: 150px; padding: 10px; background-color: ' + v.color + '">' + v.valor + '</p>');
                    $result.append('<br>');
                })
            } else {
                $result.append('<p class="text-red text-bold">¡ERROR!</p>');
                $result.append('<p class="text-red">El usuario seleccionado no ha contestado el instrumento.</p>');
            }
        });
    });
});