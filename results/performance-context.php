<?php include 'class/User.php' ?>
<?php $us = new User() ?>

<section class="content-header">
    <h1>Resultados
        <small>Contexto para el desempeño</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Contexto para el desempeño</li>
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
            <h3 class="box-title">Despliegue del Contexto para el Desempeño</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-sm-3 text-center">
                    <button class="btn btn-block bg-green" style="margin-bottom: 5px">Crear</button>
                    <p>Iniciar un Cambio</p>
                    <p>Incentivar la Creatividad</p>
                    <p>Anticipar las Necesidades</p>
                    <p>Abogar por el Crecimiento</p>
                </div>

                <div class="col-sm-3 text-center">
                    <button class="btn btn-block btn-warning" style="margin-bottom: 5px">Competir</button>
                    <p>Enfatizar la Urgencia</p>
                    <p>Establecer un Enfoque Externo</p>
                    <p>Generar Resultados</p>
                    <p>Modelar la Productividad</p>
                </div>

                <div class="col-sm-3 text-center">
                    <button class="btn btn-block btn-primary" style="margin-bottom: 5px">Controlar</button>
                    <p>Asegurar cumplimiento de Normas</p>
                    <p>Supervisar la Calidad</p>
                    <p>Controlar los Proyectos</p>
                    <p>Analizar la Eficiencia</p>
                </div>

                <div class="col-sm-3 text-center">
                    <button class="btn btn-block btn-danger" style="margin-bottom: 5px">Colaborar</button>
                    <p>Fomentar la Participación</p>
                    <p>Establecer Cohesión</p>
                    <p>Desarrollo de Personas</p>
                    <p>Mostrar Interés</p>
                </div>
            </div>

            <div class="row" style="margin-top: 20px">
                <div class="col-sm-12 col-md-6 col-md-offset-3">
                    <canvas id="myChart" width="600" height="500"<?php if ($_admin or $_superv): ?> style="display: none"<?php endif ?>></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="results/performance-context.js"></script>