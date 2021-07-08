$(document).ready(function () {
    const ctx1 = $('#myChart1'), ctx2 = $('#myChart2'), ctx3 = $('#myChart3'), ctx4 = $('#myChart4'), $group = $('#iNgroup');
    const chartOptions = {
        responsive: true,
        plugins: {legend: {labels: {font: {size: 16}}}}, scales: {x: {min: -10, max: 10, ticks: {stepSize: 5}}, y: {ticks: {font: {size: 11}}}},
        indexAxis: 'y'
    };

    let myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {labels: [], datasets: []},
        options: chartOptions
    });
    let myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {labels: [], datasets: []},
        options: chartOptions
    });
    let myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {labels: [], datasets: []},
        options: chartOptions
    });
    let myChart4 = new Chart(ctx4, {
        type: 'bar',
        data: {labels: [], datasets: []},
        options: chartOptions
    });

    $('#submitLoaderSearch').css('display', 'none');
    ctx1.css('display', 'none');
    ctx2.css('display', 'none');
    ctx3.css('display', 'none');
    ctx4.css('display', 'none');

    $('#btnsearch').click(function () {
        ctx1.css('display', 'none');
        ctx2.css('display', 'none');
        ctx3.css('display', 'none');
        ctx4.css('display', 'none');
        myChart1.clear();
        myChart2.clear();
        myChart3.clear();
        myChart4.clear();

        $.ajax({
            type: 'POST',
            url: 'consolidated/ajax.getTeamResultsByGroup.php',
            dataType: 'json',
            data: {group: $group.val(), test: 2, graph: 1}
        }).done(function (r) {
            if (r.labels[0] !== '') {
                ctx1.css('display', 'block');

                setTimeout(function () {
                    let lbl = [], vals = [], cols = [];
                    $.each(r.labels, function (k, v) {
                        lbl.push(v);
                        vals.push(r.values[k]);
                        cols.push(r.colors[k]);
                    });
                    myChart1.config.data = {
                        labels: lbl,
                        datasets: [{
                            label: 'Alineamiento de metas',
                            data: vals,
                            backgroundColor: cols
                        }]
                    }
                    myChart1.update();
                }, 500);
            }
        });

        $.ajax({
            type: 'POST',
            url: 'consolidated/ajax.getTeamResultsByGroup.php',
            dataType: 'json',
            data: {group: $group.val(), test: 2, graph: 2}
        }).done(function (r) {
            if (r.labels[0] !== '') {
                ctx2.css('display', 'block');

                setTimeout(function () {
                    let lbl = [], vals = [], cols = [];
                    $.each(r.labels, function (k, v) {
                        lbl.push(v);
                        vals.push(r.values[k]);
                        cols.push(r.colors[k]);
                    });
                    myChart2.config.data = {
                        labels: lbl,
                        datasets: [{
                            label: 'Claridad estructural',
                            data: vals,
                            backgroundColor: cols
                        }]
                    }
                    myChart2.update();
                }, 500);
            }
        });

        $.ajax({
            type: 'POST',
            url: 'consolidated/ajax.getTeamResultsByGroup.php',
            dataType: 'json',
            data: {group: $group.val(), test: 2, graph: 3}
        }).done(function (r) {
            if (r.labels[0] !== '') {
                ctx3.css('display', 'block');

                setTimeout(function () {
                    let lbl = [], vals = [], cols = [];
                    $.each(r.labels, function (k, v) {
                        lbl.push(v);
                        vals.push(r.values[k]);
                        cols.push(r.colors[k]);
                    });
                    myChart3.config.data = {
                        labels: lbl,
                        datasets: [{
                            label: 'Agilidad de cambio',
                            data: vals,
                            backgroundColor: cols
                        }]
                    }
                    myChart3.update();
                }, 500);
            }
        });

        $.ajax({
            type: 'POST',
            url: 'consolidated/ajax.getTeamResultsByGroup.php',
            dataType: 'json',
            data: {group: $group.val(), test: 2, graph: 4}
        }).done(function (r) {
            if (r.labels[0] !== '') {
                ctx4.css('display', 'block');

                setTimeout(function () {
                    let lbl = [], vals = [], cols = [];
                    $.each(r.labels, function (k, v) {
                        lbl.push(v);
                        vals.push(r.values[k]);
                        cols.push(r.colors[k]);
                    });
                    myChart4.config.data = {
                        labels: lbl,
                        datasets: [{
                            label: 'Alineamiento de metas',
                            data: vals,
                            backgroundColor: cols
                        }]
                    }
                    myChart4.update();
                }, 500);
            }
        });
    });
});