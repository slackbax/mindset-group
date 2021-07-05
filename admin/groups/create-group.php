<?php include 'class/User.php' ?>
<?php $us = new User() ?>

<section class="content-header">
    <h1>Administración
        <small>Creación de grupos</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Creación de grupos</li>
    </ol>
</section>

<section class="content container-fluid">
    <form role="form" id="formNewGroup">
        <p class="bg-class bg-danger">Los campos marcados con (*) son obligatorios</p>

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Información del grupo</h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="form-group col-sm-6 col-lg-4 has-feedback" id="gname">
                        <label class="control-label" for="iNname">Nombre *</label>
                        <input type="text" class="form-control" id="iNname" name="iname" placeholder="Ingresa nombre del grupo" required>
                        <i class="fa form-control-feedback" id="iconname"></i>
                    </div>
                </div>
            </div>

            <div class="box-header with-border">
                <h3 class="box-title">Usuarios asignados</h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="form-group col-sm-6 col-lg-5 has-feedback" id="gusuario">
                        <label class="control-label" for="iNusuario">Usuario</label>
                        <select class="form-control" id="iNusuario" name="iusuario">
                            <option value="">Selecciona usuario</option>
                            <?php $u = $us->getByProfile(2) ?>
                            <?php foreach ($u as $k => $user): ?>
                                <option value="<?php echo $user->us_id ?>"><?php echo $user->us_nombres . ' ' . $user->us_ap . ' ' . $user->us_am ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="col-sm-3 col-lg-2 col-button">
                        <button type="button" class="btn btn-info btn-block btn-sm" id="btn-add-user"><i class="fa fa-plus"></i> Asignar usuario</button>
                    </div>
                </div>

                <input type="hidden" name="inuser" id="iNnuser">

                <div id="divUsers" style="padding: 2px 10px; margin-bottom: 10px; background-color: #f2f2f2; border: 2px solid #f2f2f2">
                    <div class="row">
                        <div class="form-group col-xs-10 col-lg-11">
                            <p class="form-control-static"><strong>Nombre</strong></p>
                        </div>
                        <div class="form-group col-xs-2 col-lg-1 text-center">
                            <p class="form-control-static"></p>
                        </div>
                    </div>

                    <div id="divUsers-inner">
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <p class="form-control-static"><em>No se han agregado usuarios al grupo.</em></p>
                            </div>
                        </div>
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

<script src="admin/groups/create-group.js"></script>