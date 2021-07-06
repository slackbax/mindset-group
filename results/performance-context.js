$(document).ready(function () {
    const ctx = $('#myChart'), ctx2 = $('#myChart2');
    /*let myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: [],
            datasets: []
        },
        options: {
            animation: {
                onComplete: function () {
                    if (typeof ctx.setAttribute === 'function')
                        ctx.setAttribute('href', this.toBase64Image());
                }
            },
            responsive: true,
            legend: {
                display: false
            },
            tooltips: {
                enabled: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        drawTicks: false
                    },
                    ticks: {
                        stepSize: 5
                    }
                }],
                yAxes: [{
                    position: 'right'
                }]
            }
        }
    });*/

    let myChart2 = new Chart(ctx2, {
        type: 'radar',
        data: {
            labels: ['Iniciar un Cambio', 'Incentivar la Creatividad', 'Anticipar las Necesidades', 'Abogar por el Crecimiento', 'Enfatizar la Urgencia', 'Establecer un Enfoque Externo', 'Generar Resultados', 'Modelar la Productividad',
                'Asegurar cumplimiento de Normas', 'Supervisar la Calidad', 'Controlar los Proyectos', 'Analizar la Eficiencia', 'Fomentar la Participación', 'Establecer Cohesión', 'Desarrollo de Personas', 'Mostrar Interés'],
            datasets: []
        },
        options: {
            animation: {
                onComplete: function () {
                    if (typeof ctx.setAttribute === 'function')
                        ctx.setAttribute('href', this.toBase64Image());
                }
            },
            responsive: true,
            scale: {ticks: {min: -30, max: 30}, pointLabels: {fontSize: 14}},
        }
    })

    $('#submitLoaderSearch').css('display', 'none');

    $.ajax({
        type: 'POST',
        url: 'results/ajax.getPerformanceResultsByUser.php',
        dataType: 'json',
        data: {user: $('#iid').val(), test: 1}
    }).done(function (r) {
        if (r.labels.length > 0) {
            /*let lbl = [], vals = [], cols = [];*/

            /*$.each(r.labels, function (k, v) {
                lbl.push(v);
                vals.push(r.values[k]);
                cols.push(r.colors[k]);
            });
            myChart.config.data = {
                labels: lbl,
                datasets: [{
                    data: vals,
                    backgroundColor: cols
                }]
            }
            myChart.update();*/

            let vals = [];
            $.each(r.totals, function (k, v) {
                vals.push(r.values[k]);
            });
            myChart2.config.data = {
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
            myChart2.config.options = {
                animation: {
                    onComplete: function () {
                        ctx.setAttribute('href', this.toBase64Image());
                    }
                },
            }
            myChart2.update();
        }
    });

    $('#btnsearch').click(function () {
        ctx2.css('display', 'none');
        /*myChart.clear();*/
        myChart2.clear();

        $.ajax({
            type: 'POST',
            url: 'results/ajax.getPerformanceResultsByUser.php',
            dataType: 'json',
            data: {user: $('#iNuser').val(), test: 1}
        }).done(function (r) {
            if (r.labels[1] !== '') {
                ctx2.css('display', 'block');

                /*setTimeout(function () {
                    let lbl = [], vals = [], cols = [];

                    $.each(r.labels, function (k, v) {
                        lbl.push(v);
                        vals.push(r.values[k]);
                        cols.push(r.colors[k]);
                    });
                    myChart.config.data = {
                        labels: lbl,
                        datasets: [{
                            data: vals,
                            backgroundColor: cols
                        }]
                    }
                    myChart.update();
                }, 500);*/

                setTimeout(function () {
                    let vals = [];
                    $.each(r.totals, function (k, v) {
                        vals.push(r.values[k]);
                    });
                    myChart2.config.data = {
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
                    myChart2.config.options = {
                        animation: {
                            onComplete: function () {
                                ctx.setAttribute('href', this.toBase64Image());
                            }
                        },
                    }
                    myChart2.update();
                }, 500);
            }
        });
    });
});