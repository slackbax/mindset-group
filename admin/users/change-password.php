<section class="content-header">
	<h1>Menú de Usuario
		<small>Cambio de contraseña</small>
	</h1>

	<ol class="breadcrumb">
		<li><a href="index.php?section=home"><i class="fa fa-home"></i>Inicio</a></li>
		<li class="active">Cambio de contraseña</li>
	</ol>
</section>

<section class="content container-fluid">
	<form role="form" id="formChangePass">
		<p class="bg-class bg-danger">Los campos marcados con (*) son obligatorios</p>

		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Contraseña de Acceso</h3>
			</div>

			<div class="box-body">
				<div class="row">
					<div class="form-group col-sm-6 has-feedback" id="goldpass">
						<label for="ioldpass">Ingresa tu contraseña actual</label>
                        <input type="password" class="form-control" id="iNoldpass" name="ioldpass">
						<input type="hidden" name="uid" id="uid" value="<?php echo $_SESSION['tst_userid'] ?>">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-sm-6 has-feedback" id="gnewpass">
						<label for="inewpass">Ingresa tu nueva contraseña</label>
                        <input type="password" class="form-control" id="iNnewpass" name="inewpass">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-sm-6 has-feedback" id="gcnpass">
						<label for="icnpass">Confirme su nueva contraseña</label>
                        <input type="password" class="form-control" id="iNcnpass" name="icnpass">
					</div>
				</div>
			</div>

			<div class="box-footer">
				<button type="submit" class="btn btn-primary" id="btnsubmit"><i class="fa fa-check"></i> Guardar</button>
				<button type="reset" class="btn btn-default" id="btnClear">Limpiar</button>
				<i class="ajaxLoader fa fa-cog fa-spin" id="submitLoader"></i>
			</div>
		</div>
	</form>
</section>

<script src="admin/users/change-password.js"></script>