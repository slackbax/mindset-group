$(document).ready(function () {
    const $table1 = document.getElementById('table_result'), ctx = $('#myChart');
    const chartOptions = {
        responsive: true,
        plugins: {legend: {labels: {font: {size: 16}}}}, scales: {x: {min: 2, max: 10, ticks: {stepSize: 1}}, y: {ticks: {font: {size: 11}}}},
        indexAxis: 'y'
    };

    let myChart = new Chart(ctx, {
        type: 'bar',
        data: {labels: [], datasets: []},
        options: chartOptions
    });

    $('#submitLoaderSearch').css('display', 'none');

    $('#btnsearch').click(function () {
        ctx.css('display', 'none');
        myChart.clear();

        for (let i = 2; i <= 5; i++) {
            for (let j = 0; j <= 4; j++) {
                $table1.rows[i].cells[j].innerHTML = '';
            }
        }

        $.ajax({
            type: 'POST',
            url: 'consolidated/ajax.getHealth2ResultsByGroup.php',
            dataType: 'json',
            data: {group: $('#iNgroup').val()}
        }).done(function (r) {
            if (r['A'][0] !== 0) {
                ctx.css('display', 'block');
                let lbl = ['Ausencia de confianza', 'Temor al conflicto', 'Falta de compromiso', 'Evitación de responsabilidades', 'Falta de atención a los resultados'],
                    vals = [], cols = [];

                for (let j = 0; j <= 4; j++) {
                    $table1.rows[2].cells[j].innerHTML = r['A'][j];
                    $table1.rows[3].cells[j].innerHTML = r['B'][j];
                    $table1.rows[4].cells[j].innerHTML = r['C'][j];
                    $table1.rows[5].cells[j].innerHTML = r['total'][j];
                    vals.push(r['total'][j]);
                    $table1.rows[5].cells[j].classList = '';
                    $table1.rows[5].cells[j].classList = r['color'][j];
                    cols.push(r['barColor'][j]);
                }

                setTimeout(function () {
                    myChart.config.data = {
                        labels: lbl,
                        datasets: [{
                            label: 'Salud del equipo II',
                            data: vals,
                            backgroundColor: cols
                        }]
                    };
                    myChart.update();
                }, 500);
            }
        });
    });
});