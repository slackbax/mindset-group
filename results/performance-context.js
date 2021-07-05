$(document).ready(function () {
    const ctx = $('#myChart');
    let myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: [],
            datasets: []
        },
        options: {
            animation: {
                onComplete: function () {
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
    });

    $('#submitLoaderSearch').css('display', 'none');

    $.ajax({
        type: 'POST',
        url: 'results/ajax.getPerformanceResultsByUser.php',
        dataType: 'json',
        data: {user: $('#iid').val(), test: 1}
    }).done(function (r) {
        if (r.labels.length > 0) {
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
            if (r.labels[1] !== '') {
                ctx.css('display', 'block');

                setTimeout(function () {
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
                }, 500);
            } else {

            }
        });
    });
});