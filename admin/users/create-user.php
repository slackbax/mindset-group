<?php include 'class/Profile.php' ?>
<?php $pr = new Profile() ?>

<section class="content-header">
    <h1>Administración
        <small>Creación de usuarios</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Creación de usuarios</li>
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
                    <div class="form-group col-sm-6 col-lg-3 has-feedback" id="grut">
                        <label class="control-label" for="iNrut">RUT *</label>
                        <input type="text" class="form-control" id="iNrut" name="irut" placeholder="12.345.678-9" required>
                        <i class="fa form-control-feedback" id="iconrut"></i>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6 col-lg-4 has-feedback" id="gname">
                        <label class="control-label" for="iNname">Nombres *</label>
                        <input type="text" class="form-control" id="iNname" name="iname" placeholder="Ingresa nombres del usuario" required>
                        <i class="fa form-control-feedback" id="iconname"></i>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6 col-lg-4 has-feedback" id="glastnamep">
                        <label for="iNlastnamep">Apellido Paterno *</label>
                        <input type="text" class="form-control" id="iNlastnamep" name="ilastnamep" placeholder="Ingresa apellido paterno" required>
                        <i class="fa form-control-feedback" id="iconlastnamep"></i>
                    </div>

                    <div class="form-group col-sm-6 col-lg-4 has-feedback" id="glastnamem">
                        <label class="control-label" for="iNlastnamem">Apellido Materno *</label>
                        <input type="text" class="form-control" id="iNlastnamem" name="ilastnamem" placeholder="Ingresa apellido materno" required>
                        <i class="fa form-control-feedback" id="iconlastnamem"></i>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6 col-lg-4 has-feedback" id="gemail">
                        <label class="control-label" for="iNemail">Correo Electrónico *</label>
                        <input type="text" class="form-control" id="iNemail" name="iemail" placeholder="Ingresa e-mail del usuario" required>
                        <i class="fa form-control-feedback" id="iconEmail"></i>
                    </div>

                    <div class="form-group col-sm-6 col-lg-4 has-feedback" id="gphone">
                        <label class="control-label" for="iNphone">Teléfono *</label>
                        <input type="text" class="form-control" id="iNphone" name="iphone" placeholder="Ingresa teléfono del usuario" required>
                        <i class="fa form-control-feedback" id="iconphone"></i>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6 col-lg-4 has-feedback" id="gusername">
                        <label for="iNusername">Nombre de Usuario *</label>
                        <input type="text" class="form-control" id="iNusername" name="iusername" placeholder="Ingresa el nombre de usuario con el que entrará al sistema" maxlength="32" required>
                        <i class="fa form-control-feedback" id="iconUsername"></i>
                    </div>

                    <div class="form-group col-sm-6 col-lg-4 has-feedback">
                        <label for="iNpassword">Contraseña</label>
                        <input type="password" class="form-control" name="ipassword" id="iNpassword" placeholder="Ingrese la contraseña con la que entrará al sistema" maxlength="64" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="iNuserimage">Imagen de Cuenta</label>
                        <div class="controls">
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
                                <input type="radio" name="iprofile" class="minimal" value="<?php echo $p->perf_id ?>"<?php if ($p->perf_id == 1): ?> checked<?php endif ?>>
                                <?php echo $p->perf_descripcion ?>
                            </label>
                        </div>
                    <?php endforeach ?>
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

<script src="admin/users/create-user.js"></script>