$(document).ready(function () {
    var tableUsr = $('#tusers').DataTable({
        columns: [
            null,
            null,
            null,
            null,
            {className: 'text-center'},
            {className: 'text-center'},
            {orderable: false, width: '50px', className: 'text-center'}],
        order: [[1, 'asc'], [2, 'asc'], [0, 'asc']],
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }
        ],
        serverSide: true,
        ajax: {
            url: 'admin/users/ajax.getServerUsers.php',
            type: 'GET',
            length: 20
        }
    });

    $('#tusers').on('click', '.userDelete', function () {
        var uid = $(this).attr('id').split('_').pop();
        $(this).parent().parent().addClass('selected');

        swal({
            title: '¿Estás seguro de querer desactivar el usuario?',
            text: 'Esta acción impedirá que el usuario inicie sesión en la plataforma.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Sí'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'admin/users/ajax.delUser.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {id: uid}
                }).done(function (response) {
                    if (response.type) {
                        new Noty({
                            text: '<b>¡Éxito!</b><br>El usuario ha sido desactivado correctamente.',
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
    }).on('click', '.userActivate', function () {
        var uid = $(this).attr('id').split('_').pop();
        $(this).parent().parent().addClass('selected');

        swal({
            title: '¿Estás seguro de querer activar el usuario?',
            text: 'Esta acción permitirá que el usuario inicie sesión en la plataforma.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Sí'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'admin/users/ajax.activateUser.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {id: uid}
                }).done(function (response) {
                    if (response.type) {
                        new Noty({
                            text: '<b>¡Éxito!</b><br>El usuario ha sido activado correctamente.',
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