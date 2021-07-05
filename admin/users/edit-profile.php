<?php include 'class/User.php' ?>
<?php $us = new User() ?>
<?php $u = $us->get($_SESSION['tst_userid']) ?>

<section class="content-header">
	<h1>Menú de Usuario
		<small>Edición de perfil</small>
	</h1>

	<ol class="breadcrumb">
		<li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
		<li class="active">Edición de perfil</li>
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
                    <div class="form-group col-sm-6 col-lg-4 has-feedback" id="gname">
                        <label class="control-label" for="iname">Nombres *</label>
                        <input type="hidden" name="id" id="iNid" value="<?php echo $_SESSION['tst_userid'] ?>">
                        <input type="text" class="form-control" id="iNname" name="iname" placeholder="Ingresa nombres del usuario" value="<?php echo $u->us_nombres ?>" required>
                        <i class="fa form-control-feedback" id="iconname"></i>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6 col-lg-4 has-feedback" id="glastnamep">
                        <label for="ilastnamep">Apellido Paterno *</label>
                        <input type="text" class="form-control" id="iNlastnamep" name="ilastnamep" placeholder="Ingresa apellido paterno" value="<?php echo $u->us_ap ?>" required>
                        <i class="fa form-control-feedback" id="iconlastnamep"></i>
                    </div>

                    <div class="form-group col-sm-6 col-lg-4 has-feedback" id="glastnamem">
                        <label class="control-label" for="ilastnamem">Apellido Materno *</label>
                        <input type="text" class="form-control" id="iNlastnamem" name="ilastnamem" placeholder="Ingresa apellido materno" value="<?php echo $u->us_am ?>" required>
                        <i class="fa form-control-feedback" id="iconname"></i>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6 col-lg-4 has-feedback" id="gemail">
                        <label class="control-label" for="iemail">Correo Electrónico *</label>
                        <input type="text" class="form-control" id="iNemail" name="iemail" placeholder="Ingresa e-mail del usuario" value="<?php echo $u->us_email ?>" required>
                        <i class="fa form-control-feedback" id="iconEmail"></i>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="iuserimage">Imagen de Cuenta</label>
                        <div class="controls">
                            <img src="dist/img/<?php echo $u->us_pic ?>" width="100" height="100"><br><br>
                            <input name="iuserimage[]" class="multi" id="iuserimage" type="file" size="16" accept="gif|jpg|png|jpeg" maxlength="1">
                            <p class="help-block">Formatos admitidos: GIF, JPG, JPEG, PNG</p>
                        </div>
                    </div>
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

<script src="admin/users/edit-profile.js"></script>