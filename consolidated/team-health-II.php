<?php

include 'class/Examen.php';
include 'class/Respuesta.php';
include 'class/Pregunta.php';
include 'class/Grupo.php';

$db = new myDBC();
$ex = new Examen();
$re = new Respuesta();
$pr = new Pregunta();
$gr = new Grupo();

$total1 = $total2 = $total3 = $total4 = $total5 = 0;
?>

<section class="content-header">
    <h1>Resultados
        <small>Salud del Equipo II</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Salud del equipo II</li>
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
            <h3 class="box-title">Salud del Equipo II</h3>
        </div>

        <div class="box-body">
            <h5 class="text-bold">Puntuaciones</h5>

            <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table class="table table-bordered table-hover" id="table_result">
                        <thead>
                        <tr class="bg-black">
                            <th class="text-center">Disfunción 1</th>
                            <th class="text-center">Disfunción 2</th>
                            <th class="text-center">Disfunción 3</th>
                            <th class="text-center">Disfunción 4</th>
                            <th class="text-center">Disfunción 5</th>
                        </tr>
                        <tr class="bg-gray-light">
                            <th class="text-center">Ausencia de confianza</th>
                            <th class="text-center">Temor al conflicto</th>
                            <th class="text-center">Falta de compromiso</th>
                            <th class="text-center">Evitación de responsabilidades</th>
                            <th class="text-center">Falta de atención a los resultados</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr class="text-center">
                            <?php $preg = [4, 1, 3, 2, 5] ?>
                            <?php foreach ($preg as $i => $p): ?>
                                <td></td>
                            <?php endforeach ?>
                        </tr>
                        <tr class="text-center">
                            <?php $preg = [6, 7, 8, 11, 9] ?>
                            <?php foreach ($preg as $i => $p): ?>
                                <td></td>
                            <?php endforeach ?>
                        </tr>
                        <tr class="text-center">
                            <?php $preg = [12, 10, 13, 14, 15] ?>
                            <?php foreach ($preg as $i => $p): ?>
                                <td></td>
                            <?php endforeach ?>
                        </tr>
                        </tbody>

                        <tfoot>
                        <tr class="text-center text-bold">
                            <td class="bg-gray"><?php echo $total1 ?></td>
                            <td class="bg-gray"><?php echo $total2 ?></td>
                            <td class="bg-gray"><?php echo $total3 ?></td>
                            <td class="bg-gray"><?php echo $total4 ?></td>
                            <td class="bg-gray"><?php echo $total5 ?></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="col-sm-12">
                    <h5 class="text-bold">Tabla de equivalencia</h5>
                </div>

                <div class="col-sm-6 table-responsive">
                    <table class="table table-bordered">
                        <tr class="bg-gray-light">
                            <th class="text-center">Intervalo</th>
                            <th>Observación</th>
                        </tr>
                        <tr>
                            <td class="text-center text-bold">3 - 5</td>
                            <td class="bg-red">Disfunción probablemente debe ser afrontada</td>
                        </tr>
                        <tr>
                            <td class="text-center text-bold">6 - 7</td>
                            <td class="bg-yellow">Disfunción puede ser un problema</td>
                        </tr>
                        <tr>
                            <td class="text-center text-bold">8+</td>
                            <td class="bg-green">Disfunción probablemente no es un problema</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <canvas id="myChart" width="600" height="600"<?php if ($_admin or $_superv): ?> style="display: none"<?php endif ?>></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="consolidated/team-health-II.js"></script>