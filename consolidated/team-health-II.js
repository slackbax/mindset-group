$(document).ready(function () {
    const $table1 = document.getElementById('table_result');

    $('#submitLoaderSearch').css('display', 'none');

    $('#btnsearch').click(function () {
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
                for (let j = 0; j <= 4; j++) {
                    $table1.rows[2].cells[j].innerHTML = r['A'][j];
                    $table1.rows[3].cells[j].innerHTML = r['B'][j];
                    $table1.rows[4].cells[j].innerHTML = r['C'][j];
                    $table1.rows[5].cells[j].innerHTML = r['total'][j];
                    $table1.rows[5].cells[j].classList = '';
                    $table1.rows[5].cells[j].classList = r['color'][j];
                }
            }
        });
    });
});