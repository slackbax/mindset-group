$(document).ready(function () {
    const $table = $('#tgroups');
    const tableUsr = $table.DataTable({
        columns: [
            {width: '20px', className: 'text-right'},
            null,
            null,
            {orderable: false, width: '50px', className: 'text-center'}],
        order: [[0, 'desc']],
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            }
        ],
        serverSide: true,
        ajax: {
            url: 'admin/groups/ajax.getServerGroups.php',
            type: 'GET',
            length: 20
        }
    });

    $table.on('click', '.groupDelete', function () {
        const uid = $(this).attr('id').split('_').pop();
        $(this).parent().parent().addClass('selected');

        swal({
            title: '¿Estás seguro de querer desactivar el grupo?',
            text: 'Esta acción impedirá que el grupo pueda ser utilizado en la plataforma.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Sí'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'admin/groups/ajax.delGroup.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {id: uid}
                }).done(function (response) {
                    if (response.type) {
                        new Noty({
                            text: '<b>¡Éxito!</b><br>El grupo ha sido desactivado correctamente.',
                            type: 'success'
                        }).show();
                    } else {
                        if (response.code === 0) {
                            new Noty({
                                text: '<b>¡Error!</b><br>' + response.msg,
                                type: 'error'
                            }).show();
                        } else if (response.code === 1) {
                            new Noty({
                                text: response.msg,
                                type: 'error',
                                callbacks: {
                                    afterClose: function () {
                                        document.location.replace('index.php');
                                    }
                                }
                            }).show();
                        }
                    }

                    tableUsr.ajax.reload();
                });
            } else if (result.dismiss === swal.DismissReason.cancel) {
                tableUsr.$('tr.selected').removeClass('selected');
            }
        });
    }).on('click', '.groupActivate', function () {
        const uid = $(this).attr('id').split('_').pop();
        $(this).parent().parent().addClass('selected');

        swal({
            title: '¿Estás seguro de querer activar el grupo?',
            text: 'Esta acción permitirá que el grupo pueda ser utilizado en la plataforma.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Sí'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'admin/groups/ajax.activateGroup.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {id: uid}
                }).done(function (response) {
                    if (response.type) {
                        new Noty({
                            text: '<b>¡Éxito!</b><br>El grupo ha sido activado correctamente.',
                            type: 'success'
                        }).show();
                    } else {
                        if (response.code === 0) {
                            new Noty({
                                text: '<b>¡Error!</b><br>' + response.msg,
                                type: 'error'
                            }).show();
                        } else if (response.code === 1) {
                            new Noty({
                                text: response.msg,
                                type: 'error',
                                callbacks: {
                                    afterClose: function () {
                                        document.location.replace('index.php');
                                    }
                                }
                            }).show();
                        }
                    }

                    tableUsr.ajax.reload();
                });
            } else if (result.dismiss === swal.DismissReason.cancel) {
                tableUsr.$('tr.selected').removeClass('selected');
            }
        });
    });
});