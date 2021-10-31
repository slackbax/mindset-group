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

    $('#btnsearch').click(function () {
        ctx.css('display', 'none');
        myChart.clear();

        $.ajax({
            type: 'POST',
            url: 'consolidated/ajax.getPerformanceResultsByGroup.php',
            dataType: 'json',
            data: {group: $('#iNgroup').val(), test: 1}
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