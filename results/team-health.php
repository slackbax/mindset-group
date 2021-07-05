<?php include 'class/User.php' ?>
<?php $us = new User() ?>

<section class="content-header">
    <h1>Resultados
        <small>Salud del Equipo</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Salud del equipo</li>
    </ol>
</section>

<section class="content container-fluid">
    <?php if ($_admin or $_superv): ?>
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Filtros de búsqueda</h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="form-group col-md-6 col-lg-4 has-feedback" id="guser">
                        <label class="control-label" for="iNuser">Usuario</label>
                        <select class="form-control" id="iNuser" name="iuser">
                            <option value="">Selecciona usuario</option>
                            <?php $u = $us->getByProfile(2) ?>
                            <?php foreach ($u as $k => $user): ?>
                                <option value="<?php echo $user->us_id ?>"><?php echo $user->us_nombres . ' ' . $user->us_ap . ' ' . $user->us_am ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="button" class="btn btn-primary" id="btnsearch"><i class="fa fa-search"></i> Buscar resultados</button>
                <button type="reset" class="btn btn-default" id="btnClear">Limpiar</button>
                <i class="ajaxLoader fa fa-cog fa-spin" id="submitLoaderSearch"></i>
            </div>
        </div>
    <?php else: ?>
        <input type="hidden" name="iid" id="iid" value="<?php echo $_SESSION['msg_userid'] ?>">
    <?php endif ?>

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Salud del Equipo</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-sm-6 text-center">
                    <h5 class="text-bold">Alineamiento de metas</h5>
                    <canvas id="myChart1" width="600" height="600"<?php if ($_admin or $_superv): ?> style="display: none"<?php endif ?>></canvas>
                </div>

                <div class="col-sm-6 text-center">
                    <h5 class="text-bold">Claridad estructural</h5>
                    <canvas id="myChart2" width="600" height="600"<?php if ($_admin or $_superv): ?> style="display: none"<?php endif ?>></canvas>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-sm-6 text-center">
                    <h5 class="text-bold">Agilidad de cambio</h5>
                    <canvas id="myChart3" width="600" height="600"<?php if ($_admin or $_superv): ?> style="display: none"<?php endif ?>></canvas>
                </div>

                <div class="col-sm-6 text-center">
                    <h5 class="text-bold">Conductas constructivas</h5>
                    <canvas id="myChart4" width="600" height="600"<?php if ($_admin or $_superv): ?> style="display: none"<?php endif ?>></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="results/team-health.js"></script>