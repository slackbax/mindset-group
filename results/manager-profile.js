$(document).ready(function () {
    const ctx = $('#myChart'), $table1 = document.getElementById('table_result');
    let myChart = new Chart(ctx, {
        plugins: [ChartDataLabels],
        type: 'radar',
        data: {
            labels: [],
            datasets: []
        },
        options: {
            plugins: {
                datalabels: {
                    color: '#dd4b39',
                    font: {size: 15, weight: 'bold'}, formatter: function (value, context) {
                        return context.chart.data.labels[context.value]
                    }
                }, legend: {labels: {font: {size: 16}}}
            },
            scales: {r: {min: 0, max: 7, pointLabels: {font: {size: 12}}}},
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
            url: 'results/ajax.getManagerResultsByUser.php',
            dataType: 'json',
            data: {user: $('#iNuser').val(), test: 5}
        }).done(function (r) {
            if (r.crear[0] !== null) {
                let first = true, cell = 4, flex = 0, vals = [0];
                for (let i = 0; i < 5; i++) {
                    vals.push(r.crear[i]);
                    $table1.rows[i + 1].cells[cell].innerHTML = r.crear[i];
                    flex += parseFloat((r.crear[i] / 5).toFixed(2));
                    if (first) {
                        cell = 3;
                        first = false;
                    }
                }
                vals[0] = parseFloat(flex.toFixed(2));
                $table1.rows[0].cells[4].innerHTML = flex.toFixed(2);

                vals.push(0);
                first = true;
                cell = 4;
                let comp = 0;
                for (let i = 0; i < 5; i++) {
                    vals.push(r.competir[i]);
                    $table1.rows[i + 7].cells[cell].innerHTML = r.competir[i];
                    comp += parseFloat((r.competir[i] / 5).toFixed(2));
                    if (first) {
                        cell = 3;
                        first = false;
                    }
                }
                vals[6] = parseFloat(comp.toFixed(2));
                $table1.rows[6].cells[4].innerHTML = comp.toFixed(2);

                vals.push(0);
                first = true;
                cell = 2;
                let cont = 0;
                for (let i = 0; i < 5; i++) {
                    vals.push(r.controlar[i]);
                    $table1.rows[i + 7].cells[cell].innerHTML = r.controlar[i];
                    cont += parseFloat((r.controlar[i] / 5).toFixed(2));
                    if (first) {
                        cell = 1;
                        first = false;
                    }
                }
                vals[12] = parseFloat(cont.toFixed(2));
                $table1.rows[6].cells[2].innerHTML = cont.toFixed(2);

                vals.push(0);
                first = true;
                cell = 2;
                let colab = 0;
                for (let i = 0; i < 5; i++) {
                    vals.push(r.colaborar[i]);
                    $table1.rows[i + 1].cells[cell].innerHTML = r.colaborar[i];
                    colab += parseFloat((r.colaborar[i] / 5).toFixed(2));
                    if (first) {
                        cell = 1;
                        first = false;
                    }
                }
                vals[18] = parseFloat(colab.toFixed(2));
                $table1.rows[0].cells[2].innerHTML = colab.toFixed(2);

                ctx.css('display', 'block');

                setTimeout(function () {
                    myChart.config.data = {
                        labels: ['FLEXIBILIDAD', 'Usando el poder ética y efectivamente', 'Campeoneando y vendiendo nuevas ideas', 'Promoviendo la innovación', 'Negociando acuerdos y compromisos', 'Impulsando y sosteniendo el cambio',
                            'FOCO EXTERNO', 'Desarrollando y comunicando una visión', 'Fijando metas y objetivos', 'Motivándose y motivando a otros', 'Diseñando y organizando', 'Manejando la ejecución y conduciendo resultados',
                            'CONTROLAR', 'Organizando el flujo de información', 'Trabajando y gestionalmente a traves de funciones', 'Planificando y coordinando proyectos', 'Midiendo y monitreando calidad y desempeño', 'Alentando y posibiltando el cumplimiento',
                            'FOCO INTERNO', 'Entendiéndome a mí y a otros', 'Comunicándome honesta y efectivamente', 'Dando tutoría y desarrollando a otros', 'Liderando equipos', 'Manejando y alentando el conflicto'],
                        datasets: [
                            {
                                label: 'Perfil Gerencial',
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