<section class="content-header">
    <div style="margin: 5px 0 15px">
        <img src="dist/img/logo_mini.png">
    </div>

	<div class="callout callout-danger">
		<h4><i class="fa fa-times"></i> Error de acceso</h4>
		<p>Has intentado ingresar a una sección restringida o inexistente. Si no estás seguro de la razón, contacta con el administrador para mayor información.</p>
		<a class="btn btn-warning" id="btnback"><i class="fa fa-undo"></i> Volver atrás</a> <a href="index.php" class="btn btn-info" id="btnback"><i class="fa fa-home"></i> Volver al inicio</a>
	</div>
</section>

<script>
    $(document).ready( function() {
        $('#btnback').click( function() {
            window.history.back();
        });
    });
</script>
