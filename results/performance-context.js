$(document).ready(function () {
    const ctx = $('#myChart');
    let myChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: [],
            datasets: []
        },
        options: {
            scales: {r: {min: -30, max: 30, pointLabels: {font: {size: 14}}}},
            responsive: true,
            spanGaps: true
        }
    })

    $('#submitLoaderSearch').css('display', 'none');

    $.ajax({
        type: 'POST',
        url: 'results/ajax.getPerformanceResultsByUser.php',
        dataType: 'json',
        data: {user: $('#iid').val(), test: 1}
    }).done(function (r) {
        if (r[0] !== '') {
            let vals = [];
            $.each(r, function (k) {
                vals.push(r[k]);
            });
            myChart.config.data = {
                labels: ['Iniciar un Cambio', 'Incentivar la Creatividad', 'Anticipar las Necesidades', 'Abogar por el Crecimiento', 'Enfatizar la Urgencia', 'Establecer un Enfoque Externo', 'Generar Resultados', 'Modelar la Productividad',
                    'Asegurar cumplimiento de Normas', 'Supervisar la Calidad', 'Controlar los Proyectos', 'Analizar la Eficiencia', 'Fomentar la Participación', 'Establecer Cohesión', 'Desarrollo de Personas', 'Mostrar Interés'],
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
        }
    });

    $('#btnsearch').click(function () {
        ctx.css('display', 'none');
        myChart.clear();

        $.ajax({
            type: 'POST',
            url: 'results/ajax.getPerformanceResultsByUser.php',
            dataType: 'json',
            data: {user: $('#iNuser').val(), test: 1}
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