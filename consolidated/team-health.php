<?php include 'class/Grupo.php' ?>
<?php $gr = new Grupo() ?>

<section class="content-header">
    <h1>Consolidados
        <small>Salud del Equipo</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Salud del equipo</li>
    </ol>
</section>

<section class="content container-fluid">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Filtros de búsqueda</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="form-group col-md-6 col-lg-4 has-feedback" id="ggroup">
                    <label class="control-label" for="iNgroup">Grupo</label>
                    <select class="form-control" id="iNgroup" name="igroup">
                        <option value="">Selecciona grupo</option>
                        <?php $g = $gr->getAll() ?>
                        <?php foreach ($g as $k => $group): ?>
                            <option value="<?php echo $group->gr_id ?>"><?php echo $group->gr_nombre ?></option>
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

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Salud del Equipo</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-sm-6 text-center">
                    <canvas id="myChart1" width="600" height="600"></canvas>
                </div>

                <div class="col-sm-6 text-center">
                    <canvas id="myChart2" width="600" height="600"></canvas>
                </div>
            </div>

            <div class="row" style="margin-top: 15px">
                <div class="col-sm-6 text-center">
                    <canvas id="myChart3" width="600" height="600"></canvas>
                </div>

                <div class="col-sm-6 text-center">
                    <canvas id="myChart4" width="600" height="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="consolidated/team-health.js"></script>