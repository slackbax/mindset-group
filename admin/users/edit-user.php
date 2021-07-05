<?php include 'class/User.php' ?>
<?php include 'class/Profile.php' ?>
<?php $us = new User() ?>
<?php $pr = new Profile() ?>
<?php $u = $us->get($id) ?>

<section class="content-header">
	<h1>Administración
		<small>Edición de usuario</small>
	</h1>

	<ol class="breadcrumb">
		<li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
		<li><a href="index.php?section=users&sbs=manageusers">Usuarios registrados</a></li>
		<li class="active">Edición de usuario</li>
	</ol>
</section>

<section class="content container-fluid">
	<form role="form" id="formNewUser">
		<p class="bg-class bg-danger">Los campos marcados con (*) son obligatorios</p>

		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Información del usuario</h3>
			</div>

			<div class="box-body">
                <div class="row">
                    <div class="form-group col-sm-6 col-lg-4 has-feedback" id="grut">
                        <label class="control-label" for="iNrut">RUT *</label>
                        <input type="hidden" name="id" id="iNid" value="<?php echo $id ?>">
                        <input type="text" class="form-control" id="iNrut" name="irut" placeholder="12.345.678-9" value="<?php echo $u->us_rut ?>" required>
                        <i class="fa form-control-feedback" id="iconrut"></i>
                    </div>
                </div>

				<div class="row">
					<div class="form-group col-sm-6 col-lg-4 has-feedback" id="gname">
						<label class="control-label" for="iNname">Nombres *</label>
						<input type="text" class="form-control" id="iNname" name="iname" placeholder="Ingresa nombres del usuario" value="<?php echo $u->us_nombres ?>" required>
						<i class="fa form-control-feedback" id="iconname"></i>
					</div>
                </div>

                <div class="row">
					<div class="form-group col-sm-6 col-lg-4 has-feedback" id="glastnamep">
						<label for="iNlastnamep">Apellido Paterno *</label>
						<input type="text" class="form-control" id="iNlastnamep" name="ilastnamep" placeholder="Ingresa apellido paterno" value="<?php echo $u->us_ap ?>" required>
						<i class="fa form-control-feedback" id="iconlastnamep"></i>
					</div>

					<div class="form-group col-sm-6 col-lg-4 has-feedback" id="glastnamem">
						<label class="control-label" for="iNlastnamem">Apellido Materno *</label>
						<input type="text" class="form-control" id="iNlastnamem" name="ilastnamem" placeholder="Ingresa apellido materno" value="<?php echo $u->us_am ?>" required>
						<i class="fa form-control-feedback" id="iconname"></i>
					</div>
                </div>

                <div class="row">
					<div class="form-group col-sm-6 col-lg-4 has-feedback" id="gemail">
						<label class="control-label" for="iNemail">Correo Electrónico *</label>
						<input type="text" class="form-control" id="iNemail" name="iemail" placeholder="Ingresa e-mail del usuario" value="<?php echo $u->us_email ?>" required>
						<i class="fa form-control-feedback" id="iconEmail"></i>
					</div>

                    <div class="form-group col-sm-6 col-lg-4 has-feedback" id="gphone">
                        <label class="control-label" for="iNphone">Teléfono *</label>
                        <input type="text" class="form-control" id="iNphone" name="iphone" placeholder="Ingresa teléfono del usuario" value="<?php echo $u->us_telefono ?>" required>
                        <i class="fa form-control-feedback" id="iconphone"></i>
                    </div>
				</div>

				<div class="row">
					<div class="form-group col-sm-6 col-lg-4 has-feedback" id="gusername">
						<label for="iNusername">Nombre de Usuario</label>
						<input type="text" class="form-control" id="iNusername" name="iusername" placeholder="Ingresa el nombre de usuario con el que entrará al sistema" value="<?php echo $u->us_username ?>" readonly>
						<i class="fa form-control-feedback" id="iconUsername"></i>
					</div>

                    <div class="form-group col-sm-6 col-lg-4 has-feedback">
                        <label for="iNpassword">Contraseña</label>
                        <input type="password" class="form-control" name="ipassword" id="ipassword" placeholder="Ingresa la contraseña con la que entrará al sistema" maxlength="64">
                    </div>
				</div>

				<div class="row">
					<div class="form-group col-sm-6 col-lg-4">
						<label for="igroups">Estado</label>
						<p>
							<label class="label-checkbox">
								<input type="checkbox" class="minimal" name="iactive"<?php if ($u->us_activo): ?> checked<?php endif ?>> Activo
							</label>
						</p>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-sm-12">
						<label for="iNuserimage">Imagen de Cuenta</label>
						<div class="controls">
							<img src="dist/img/<?php echo $u->us_pic ?>" width="100" height="100"><br><br>
							<input name="iuserimage[]" class="multi" id="iNuserimage" type="file" size="16" accept="gif|jpg|png|jpeg" maxlength="1">
							<p class="help-block">Formatos admitidos: GIF, JPG, JPEG, PNG</p>
						</div>
					</div>
				</div>
			</div>

            <div class="box-header with-border">
                <h3 class="box-title">Perfil asignado</h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <?php $pro = $pr->getAll() ?>
                    <?php foreach ($pro as $i => $p): ?>
                        <div class="form-group col-sm-12">
                            <label>
                                <input type="radio" name="iprofile" class="minimal" value="<?php echo $p->perf_id ?>"<?php if ($p->perf_id == $u->perf_id): ?> checked<?php endif ?>>
                                <?php echo $p->perf_descripcion ?>
                            </label>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

			<div class="box-footer">
				<button type="submit" class="btn btn-primary" id="btnsubmit"><i class="fa fa-check"></i> Editar</button>
                <button type="button" class="btn btn-default" id="btnClear">Limpiar</button>
				<i class="ajaxLoader fa fa-cog fa-spin" id="submitLoader"></i>
			</div>
		</div>
	</form>
</section>

<!-- pincode-input -->
<script src="bower_components/bootstrap-pincode-input/js/bootstrap-pincode-input.js"></script>
<script src="admin/users/edit-user.js"></script>