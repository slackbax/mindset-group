<?php
function evaluateScore($v): string
{
    if ($v <= 5):
        $str = 'bg-red';
    elseif ($v > 5 and $v <= 7):
        $str = 'bg-yellow';
    else:
        $str = 'bg-green';
    endif;

    return $str;
}

include 'class/Examen.php';
include 'class/Respuesta.php';
include 'class/Pregunta.php';
include 'class/User.php';

$db = new myDBC();
$ex = new Examen();
$re = new Respuesta();
$pr = new Pregunta();
$us = new User();

if (!$_admin and !$_superv)
    $exa = $ex->getByUserTestType($_SESSION['msg_userid'], 3, $db);
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
                                <?php $res = $re->getByExamenNumber($exa->exa_id, $p); ?>
                                <?php if ($i == 0) $total1 += $res->res_valor ?>
                                <?php if ($i == 1) $total2 += $res->res_valor ?>
                                <?php if ($i == 2) $total3 += $res->res_valor ?>
                                <?php if ($i == 3) $total4 += $res->res_valor ?>
                                <?php if ($i == 4) $total5 += $res->res_valor ?>
                                <td><?php echo $res->res_valor ?></td>
                            <?php endforeach ?>
                        </tr>
                        <tr class="text-center">
                            <?php $preg = [6, 7, 8, 11, 9] ?>
                            <?php foreach ($preg as $i => $p): ?>
                                <?php $res = $re->getByExamenNumber($exa->exa_id, $p); ?>
                                <?php if ($i == 0) $total1 += $res->res_valor ?>
                                <?php if ($i == 1) $total2 += $res->res_valor ?>
                                <?php if ($i == 2) $total3 += $res->res_valor ?>
                                <?php if ($i == 3) $total4 += $res->res_valor ?>
                                <?php if ($i == 4) $total5 += $res->res_valor ?>
                                <td><?php echo $res->res_valor ?></td>
                            <?php endforeach ?>
                        </tr>
                        <tr class="text-center">
                            <?php $preg = [12, 10, 13, 14, 15] ?>
                            <?php foreach ($preg as $i => $p): ?>
                                <?php $res = $re->getByExamenNumber($exa->exa_id, $p); ?>
                                <?php if ($i == 0) $total1 += $res->res_valor ?>
                                <?php if ($i == 1) $total2 += $res->res_valor ?>
                                <?php if ($i == 2) $total3 += $res->res_valor ?>
                                <?php if ($i == 3) $total4 += $res->res_valor ?>
                                <?php if ($i == 4) $total5 += $res->res_valor ?>
                                <td><?php echo $res->res_valor ?></td>
                            <?php endforeach ?>
                        </tr>
                        </tbody>

                        <tfoot>
                        <tr class="text-center text-bold">
                            <td class="<?php echo evaluateScore($total1) ?>"><?php echo $total1 ?></td>
                            <td class="<?php echo evaluateScore($total2) ?>"><?php echo $total2 ?></td>
                            <td class="<?php echo evaluateScore($total3) ?>"><?php echo $total3 ?></td>
                            <td class="<?php echo evaluateScore($total4) ?>"><?php echo $total4 ?></td>
                            <td class="<?php echo evaluateScore($total5) ?>"><?php echo $total5 ?></td>
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

<script src="results/team-health-II.js"></script>