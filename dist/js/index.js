$(document).ready(function () {

	$('table').tooltip({
		html: true,
		selector: '[data-tooltip=tooltip]',
		trigger: 'hover'
	});

	$('body').tooltip({
		html: true,
		selector: '[rel=tooltip]',
		trigger: 'hover'
	});

	$('#btn-help').click(function () {
		swal({
			title: "¿Necesitas ayuda?",
			html: 'Para cualquier duda o sugerencia, puedes contactar al soporte de la aplicación al e-mail <a href="mailto:soporte@mindsetgroup.cl">soporte@mindsetgroup.cl</a><br><br>',
			type: "warning",
			showCancelButton: false,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: '<i class="fa fa-thumbs-up"></i> Aceptar'
		});
	});

	$('#btn-logout').click(function () {
		swal({
			title: "¿Estás seguro de querer salir?",
			text: "Esta acción cerrará tu sesión en el sistema.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Sí"
		}).then((result) => {
			if(result.value) {
				$.ajax({
					type: "POST",
					url: "src/logout.php",
					data: {src: 'btn'}
				}).done(function (msg) {
					if (msg === 'true') {
						window.location.replace('index.php');
					}
				});
			}
		});
	});

	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		checkboxClass: 'icheckbox_square-red',
		radioClass: 'iradio_square-red'
	});
});