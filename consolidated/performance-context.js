$(document).ready(function () {
    const ctx = $('#myChart');
    let myChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: [],
            datasets: []
        },
        options: {
            scales: {r: {pointLabels: {font: {size: 14}}}},
            responsive: true,
            spanGaps: true
        }
    })

    $('#submitLoaderSearch').css('display', 'none');
    ctx.css('display', 'none');

    $('#iNenterprise').change(function () {
        $('#iNgroup').html('').append('<option value="">Cargando grupos...</option>');
        $('#ggroup').removeClass('has-error has-success');

        $.ajax({
            type: 'POST',
            url: 'consolidated/ajax.getGroupsByEnterprise.php',
            dataType: 'json',
            data: {id: $(this).val()}
        }).done(function (data) {
            $('#iNgroup').html('').append('<option value="">TODOS LOS GRUPOS</option>');

            $.each(data, function (k, v) {
                $('#iNgroup').append(
                    $('<option></option>').val(v.gr_id).html(v.gr_nombre)
                );
            });
        });
    });

    $('#btnsearch').click(function () {
        ctx.css('display', 'none');
        myChart.clear();

        $.ajax({
            type: 'POST',
            url: 'consolidated/ajax.getPerformanceResultsByGroup.php',
            dataType: 'json',
            data: {emp: $('#iNenterprise').val(), group: $('#iNgroup').val(), test: 1}
        }).done(function (r) {
            if (r[0] !== '') {
                ctx.css('display', 'block');

                setTimeout(function () {
                    let vals = [];
                    $.each(r, function (k) {
                        vals.push(r[k]);
                    });

                    myChart.config.data = {
                        labels: ['FLEXIBILIDAD', 'Iniciar un Cambio', 'Incentivar la Creatividad', 'Anticipar las Necesidades', 'Abogar por el Crecimiento', 'FOCO EXTERNO', 'Enfatizar la Urgencia', 'Establecer un Enfoque Externo', 'Generar Resultados', 'Modelar la Productividad',
                            'CONTROL', 'Asegurar cumplimiento de Normas', 'Supervisar la Calidad', 'Controlar los Proyectos', 'Analizar la Eficiencia', 'FOCO INTERNO', 'Fomentar la Participación', 'Establecer Cohesión', 'Desarrollo de Personas', 'Mostrar Interés'],
                        datasets: [
                            {
                                label: 'Contexto para el desempeño',
                                data: vals,
                                backgroundColor: 'rgba(0, 115, 183, 0.2)',
                                borderColor: '#0073b7'
                            }
                        ]
                    }
                    myChart.update();
                }, 500);
            }
        });
    });
});