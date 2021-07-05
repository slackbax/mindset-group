$(document).ready(function () {
    const ctx = $('#myChart'), $table1 = document.getElementById('table_p_a'), $table2 = document.getElementById('table_p_d'), $table3 = document.getElementById('table_full');
    let myChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['Flexibilidad', 'Foco Externo', 'Control', 'Foco Interno'],
            datasets: [
                {
                    label: 'Actual',
                    data: [$('#total1').val(), $('#total3').val(), $('#total5').val(), $('#total7').val()],
                    backgroundColor: 'rgba(221, 75, 57, 0.6)',
                    borderColor: '#dd4b39'
                },
                {
                    label: 'Deseada',
                    data: [$('#total2').val(), $('#total4').val(), $('#total6').val(), $('#total8').val()],
                    backgroundColor: 'rgba(0, 115, 183, 0.6)',
                    borderColor: '#0073b7'
                }
            ]
        },
        options: {
            animation: {
                onComplete: function () {
                    if (typeof ctx.setAttribute === 'function')
                        ctx.setAttribute('href', this.toBase64Image());
                }
            },
            responsive: true,
            scale: {ticks: {min: 0, max: 100}, pointLabels: {fontSize: 16}},
        }
    }), val1 = [], val2 = [];

    $('#submitLoaderSearch').css('display', 'none');

    $('#btnsearch').click(function () {
        myChart.clear();
        ctx.css('display', 'none');

        for (let i = 1; i <= 8; i++) {
            for (let j = 1; j <= 4; j++) {
                $table1.rows[i].cells[j].innerHTML = '';
                $table2.rows[i].cells[j].innerHTML = '';
            }
        }

        for (let i = 2; i <= 9; i++) {
            for (let j = 1; j <= 8; j++) {
                $table3.rows[i].cells[j].innerHTML = '';
            }
        }

        $.ajax({
            type: 'POST',
            url: 'results/ajax.getCompetitiveResultsByUser.php',
            dataType: 'json',
            data: {user: $('#iNuser').val(), test: 1}
        }).done(function (r) {
            if (r[1]['A'][0] !== null) {
                val1 = []; val2 = [];
                ctx.css('display', 'block');

                let total1 = 0, total2 = 0, total3 = 0, total4 = 0;
                for (let i = 1; i <= 6; i++) {
                    $table1.rows[i].cells[1].innerHTML = r[i]['A'][0];
                    $table3.rows[i + 1].cells[1].innerHTML = r[i]['A'][0];
                    total1 += parseInt(r[i]['A'][0]);
                    $table1.rows[i].cells[2].innerHTML = r[i]['A'][1];
                    $table3.rows[i + 1].cells[3].innerHTML = r[i]['A'][1];
                    total2 += parseInt(r[i]['A'][1]);
                    $table1.rows[i].cells[3].innerHTML = r[i]['A'][2];
                    $table3.rows[i + 1].cells[5].innerHTML = r[i]['A'][2];
                    total3 += parseInt(r[i]['A'][2]);
                    $table1.rows[i].cells[4].innerHTML = r[i]['A'][3];
                    $table3.rows[i + 1].cells[7].innerHTML = r[i]['A'][3];
                    total4 += parseInt(r[i]['A'][3]);
                }

                $table1.rows[7].cells[1].innerHTML = total1;
                $table3.rows[8].cells[1].innerHTML = total1;
                $table1.rows[7].cells[2].innerHTML = total2;
                $table3.rows[8].cells[3].innerHTML = total2;
                $table1.rows[7].cells[3].innerHTML = total3;
                $table3.rows[8].cells[5].innerHTML = total3;
                $table1.rows[7].cells[4].innerHTML = total4;
                $table3.rows[8].cells[7].innerHTML = total4;
                $table1.rows[8].cells[1].innerHTML = number_format(total1 / 6, 1, '.', '');
                $table3.rows[9].cells[1].innerHTML = number_format(total1 / 6, 1, '.', '');
                $table1.rows[8].cells[2].innerHTML = number_format(total2 / 6, 1, '.', '');
                $table3.rows[9].cells[3].innerHTML = number_format(total2 / 6, 1, '.', '');
                $table1.rows[8].cells[3].innerHTML = number_format(total3 / 6, 1, '.', '');
                $table3.rows[9].cells[5].innerHTML = number_format(total3 / 6, 1, '.', '');
                $table1.rows[8].cells[4].innerHTML = number_format(total4 / 6, 1, '.', '');
                $table3.rows[9].cells[7].innerHTML = number_format(total4 / 6, 1, '.', '');
                val1.push((total1 / 6).toFixed(1));
                val1.push((total2 / 6).toFixed(1));
                val1.push((total3 / 6).toFixed(1));
                val1.push((total4 / 6).toFixed(1));


                total1 = 0;
                total2 = 0;
                total3 = 0;
                total4 = 0;
                for (let i = 1; i <= 6; i++) {
                    $table2.rows[i].cells[1].innerHTML = r[i]['D'][0];
                    $table3.rows[i + 1].cells[2].innerHTML = r[i]['D'][0];
                    total1 += parseInt(r[i]['D'][0]);
                    $table2.rows[i].cells[2].innerHTML = r[i]['D'][1];
                    $table3.rows[i + 1].cells[4].innerHTML = r[i]['D'][1];
                    total2 += parseInt(r[i]['D'][1]);
                    $table2.rows[i].cells[3].innerHTML = r[i]['D'][2];
                    $table3.rows[i + 1].cells[6].innerHTML = r[i]['D'][2];
                    total3 += parseInt(r[i]['D'][2]);
                    $table2.rows[i].cells[4].innerHTML = r[i]['D'][3];
                    $table3.rows[i + 1].cells[8].innerHTML = r[i]['D'][3];
                    total4 += parseInt(r[i]['D'][3]);
                }

                $table2.rows[7].cells[1].innerHTML = total1;
                $table3.rows[8].cells[2].innerHTML = total1;
                $table2.rows[7].cells[2].innerHTML = total2;
                $table3.rows[8].cells[4].innerHTML = total2;
                $table2.rows[7].cells[3].innerHTML = total3;
                $table3.rows[8].cells[6].innerHTML = total3;
                $table2.rows[7].cells[4].innerHTML = total4;
                $table3.rows[8].cells[8].innerHTML = total4;
                $table2.rows[8].cells[1].innerHTML = number_format(total1 / 6, 1, '.', '');
                $table3.rows[9].cells[2].innerHTML = number_format(total1 / 6, 1, '.', '');
                $table2.rows[8].cells[2].innerHTML = number_format(total2 / 6, 1, '.', '');
                $table3.rows[9].cells[4].innerHTML = number_format(total2 / 6, 1, '.', '');
                $table2.rows[8].cells[3].innerHTML = number_format(total3 / 6, 1, '.', '');
                $table3.rows[9].cells[6].innerHTML = number_format(total3 / 6, 1, '.', '');
                $table2.rows[8].cells[4].innerHTML = number_format(total4 / 6, 1, '.', '');
                $table3.rows[9].cells[8].innerHTML = number_format(total4 / 6, 1, '.', '');
                val2.push((total1 / 6).toFixed(1));
                val2.push((total2 / 6).toFixed(1));
                val2.push((total3 / 6).toFixed(1));
                val2.push((total4 / 6).toFixed(1));

                setTimeout(function () {
                    myChart.config.data = {
                        labels: ['Flexibilidad', 'Foco Externo', 'Control', 'Foco Interno'],
                        datasets: [
                            {
                                label: 'Actual',
                                data: val1,
                                backgroundColor: 'rgba(221, 75, 57, 0.6)',
                                borderColor: '#dd4b39'
                            },
                            {
                                label: 'Deseada',
                                data: val2,
                                backgroundColor: 'rgba(0, 115, 183, 0.6)',
                                borderColor: '#0073b7'
                            }
                        ]
                    }
                    myChart.config.options = {
                        animation: {
                            onComplete: function () {
                                ctx.setAttribute('href', this.toBase64Image());
                            }
                        },
                    }
                    myChart.update();
                }, 500);
            }
        });
    });
});