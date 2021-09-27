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
			html: 'Para cualquier duda o sugerencia, puedes contactar al soporte de la aplicación al e-mail <a class="text-bold" target="_blank" href="mailto:it@mindsetgroup.cl">it@mindsetgroup.cl</a> ' +
				'o por WhatsApp al número <a class="text-bold" target="_blank" href="https://wa.me/56999195279?text=Necesito%20ayuda%20con%20la%20aplicacion%20de%20MindsetGroup">+56 9 9919 5279</a>',
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