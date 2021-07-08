<?php
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
    $exa = $ex->getByUserTestType($_SESSION['msg_userid'], 4, $db);
$profile = ['Características Dominantes', 'Líder de la Organización', 'Dirección de los Colaboradores', 'Unidad Organizacional', 'Énfasis Estratégico', 'Criterios de Éxito'];
?>

<section class="content-header">
    <h1>Resultados
        <small>Perfil Competitivo</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Perfil competitivo</li>
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
            <h3 class="box-title">Resultados Perfil Competitivo</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-sm-6 table-responsive">
                    <table class="table table-bordered table-hover" id="table_p_a">
                        <thead>
                        <tr class="bg-gray-light">
                            <th>Perfil Actual</th>
                            <th class="text-center">A</th>
                            <th class="text-center">B</th>
                            <th class="text-center">C</th>
                            <th class="text-center">D</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $total1 = $total2 = $total3 = $total4 = 0 ?>
                        <?php $index_p = 1; ?>
                        <?php foreach ($profile as $pi => $pp): ?>
                            <tr>
                                <td><?php echo $pi + 1 . '. ' . $pp ?></td>
                                <?php $preg = [1, 2, 3, 4] ?>
                                <?php foreach ($preg as $i => $p): ?>
                                    <?php $res = $re->getByExamenNumber($exa->exa_id, $index_p); ?>
                                    <?php if ($i == 0) $total1 += $res->res_valor ?>
                                    <?php if ($i == 1) $total2 += $res->res_valor ?>
                                    <?php if ($i == 2) $total3 += $res->res_valor ?>
                                    <?php if ($i == 3) $total4 += $res->res_valor ?>
                                    <td class="text-center"><?php echo $res->res_valor ?></td>
                                    <?php $index_p++; ?>
                                <?php endforeach ?>
                            </tr>
                        <?php endforeach ?>
                        <tr class="text-center text-bold bg-gray">
                            <th>Total</th>
                            <td><?php echo $total1 ?></td>
                            <td><?php echo $total2 ?></td>
                            <td><?php echo $total3 ?></td>
                            <td><?php echo $total4 ?></td>
                        </tr>
                        <tr class="text-center text-bold bg-red">
                            <th>Promedio</th>
                            <td><?php echo number_format($total1 / 6, 1, '.', '') ?></td>
                            <td><?php echo number_format($total2 / 6, 1, '.', '') ?></td>
                            <td><?php echo number_format($total3 / 6, 1, '.', '') ?></td>
                            <td><?php echo number_format($total4 / 6, 1, '.', '') ?></td>
                        </tr>
                        </tbody>

                        <tfoot>
                        <tr>
                            <th>Perfil</th>
                            <th class="text-center">Clan</th>
                            <th class="text-center">Adhocrático</th>
                            <th class="text-center">Mercado</th>
                            <th class="text-center">Jerarquía</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="col-sm-6 table-responsive">
                    <table class="table table-bordered table-hover" id="table_p_d">
                        <thead>
                        <tr class="bg-gray-light">
                            <th>Perfil Deseado</th>
                            <th class="text-center">A</th>
                            <th class="text-center">B</th>
                            <th class="text-center">C</th>
                            <th class="text-center">D</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $total1 = $total2 = $total3 = $total4 = 0 ?>
                        <?php $index_p = 1; ?>
                        <?php foreach ($profile as $pi => $pp): ?>
                            <tr>
                                <td><?php echo $pi + 1 . '. ' . $pp ?></td>
                                <?php $preg = [1, 2, 3, 4] ?>
                                <?php foreach ($preg as $i => $p): ?>
                                    <?php $res = $re->getByExamenNumber($exa->exa_id, $index_p); ?>
                                    <?php if ($i == 0) $total1 += $res->res_valor_sec ?>
                                    <?php if ($i == 1) $total2 += $res->res_valor_sec ?>
                                    <?php if ($i == 2) $total3 += $res->res_valor_sec ?>
                                    <?php if ($i == 3) $total4 += $res->res_valor_sec ?>
                                    <td class="text-center"><?php echo $res->res_valor_sec ?></td>
                                    <?php $index_p++; ?>
                                <?php endforeach ?>
                            </tr>
                        <?php endforeach ?>
                        <tr class="text-center text-bold bg-gray">
                            <th>Total</th>
                            <td><?php echo $total1 ?></td>
                            <td><?php echo $total2 ?></td>
                            <td><?php echo $total3 ?></td>
                            <td><?php echo $total4 ?></td>
                        </tr>
                        <tr class="text-center text-bold bg-blue">
                            <th>Promedio</th>
                            <td><?php echo number_format($total1 / 6, 1, '.', '') ?></td>
                            <td><?php echo number_format($total2 / 6, 1, '.', '') ?></td>
                            <td><?php echo number_format($total3 / 6, 1, '.', '') ?></td>
                            <td><?php echo number_format($total4 / 6, 1, '.', '') ?></td>
                        </tr>
                        </tbody>

                        <tfoot>
                        <tr>
                            <th>Perfil</th>
                            <th class="text-center">Clan</th>
                            <th class="text-center">Adhocrático</th>
                            <th class="text-center">Mercado</th>
                            <th class="text-center">Jerarquía</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="box-header with-border">
            <h3 class="box-title">Resumen</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table class="table table-bordered table-hover" id="table_full">
                        <thead>
                        <tr class="bg-gray-light">
                            <th rowspan="2" class="text-center">Item</th>
                            <th colspan="2" class="text-center">A</th>
                            <th colspan="2" class="text-center">B</th>
                            <th colspan="2" class="text-center">C</th>
                            <th colspan="2" class="text-center">D</th>
                        </tr>

                        <tr class="text-bold">
                            <td class="text-center text-red">Actual</td>
                            <td class="text-center text-blue">Deseado</td>
                            <td class="text-center text-red">Actual</td>
                            <td class="text-center text-blue">Deseado</td>
                            <td class="text-center text-red">Actual</td>
                            <td class="text-center text-blue">Deseado</td>
                            <td class="text-center text-red">Actual</td>
                            <td class="text-center text-blue">Deseado</td>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $total1 = $total2 = $total3 = $total4 = $total5 = $total6 = $total7 = $total8 = 0 ?>
                        <?php $index_p = 1; ?>
                        <?php foreach ($profile as $pi => $pp): ?>
                            <tr class="text-center">
                                <td class="text-bold"><?php echo $pi + 1 ?></td>
                                <?php $preg = [1, 2, 3, 4] ?>
                                <?php foreach ($preg as $i): ?>
                                    <?php $res = $re->getByExamenNumber($exa->exa_id, $index_p); ?>
                                    <?php if ($i == 1): $total1 += $res->res_valor;
                                        $total2 += $res->res_valor_sec; endif ?>
                                    <?php if ($i == 2): $total3 += $res->res_valor;
                                        $total4 += $res->res_valor_sec; endif ?>
                                    <?php if ($i == 3): $total5 += $res->res_valor;
                                        $total6 += $res->res_valor_sec; endif ?>
                                    <?php if ($i == 4): $total7 += $res->res_valor;
                                        $total8 += $res->res_valor_sec; endif ?>
                                    <td><?php echo $res->res_valor ?></td>
                                    <td><?php echo $res->res_valor_sec ?></td>
                                    <?php $index_p++; ?>
                                <?php endforeach ?>
                            </tr>
                        <?php endforeach ?>
                        </tbody>

                        <tfoot>
                        <tr class="text-center text-bold bg-gray">
                            <td>Total</td>
                            <td><?php echo $total1 ?></td>
                            <td><?php echo $total2 ?></td>
                            <td><?php echo $total3 ?></td>
                            <td><?php echo $total4 ?></td>
                            <td><?php echo $total5 ?></td>
                            <td><?php echo $total6 ?></td>
                            <td><?php echo $total7 ?></td>
                            <td><?php echo $total8 ?></td>
                        </tr>
                        <tr class="text-center text-bold">
                            <td class="bg-gray">Promedio</td>
                            <td class="bg-red"><?php echo round($total1 / 600 * 100) . '%' ?></td>
                            <td class="bg-blue"><?php echo round($total2 / 600 * 100) . '%' ?></td>
                            <td class="bg-red"><?php echo round($total3 / 600 * 100) . '%' ?></td>
                            <td class="bg-blue"><?php echo round($total4 / 600 * 100) . '%' ?></td>
                            <td class="bg-red"><?php echo round($total5 / 600 * 100) . '%' ?></td>
                            <td class="bg-blue"><?php echo round($total6 / 600 * 100) . '%' ?></td>
                            <td class="bg-red"><?php echo round($total7 / 600 * 100) . '%' ?></td>
                            <td class="bg-blue"><?php echo round($total8 / 600 * 100) . '%' ?></td>
                        </tr>
                        <tr class="text-center text-bold">
                            <td>Perfil</td>
                            <td colspan="2">Clan</td>
                            <td colspan="2">Adhocrático</td>
                            <td colspan="2">Mercado</td>
                            <td colspan="2">Jerarquía</td>
                        </tr>
                        </tfoot>
                    </table>
                    <input type="hidden" id="total1" value="<?php echo round($total1 / 600 * 100) ?>">
                    <input type="hidden" id="total2" value="<?php echo round($total2 / 600 * 100) ?>">
                    <input type="hidden" id="total3" value="<?php echo round($total3 / 600 * 100) ?>">
                    <input type="hidden" id="total4" value="<?php echo round($total4 / 600 * 100) ?>">
                    <input type="hidden" id="total5" value="<?php echo round($total5 / 600 * 100) ?>">
                    <input type="hidden" id="total6" value="<?php echo round($total6 / 600 * 100) ?>">
                    <input type="hidden" id="total7" value="<?php echo round($total7 / 600 * 100) ?>">
                    <input type="hidden" id="total8" value="<?php echo round($total8 / 600 * 100) ?>">
                </div>
            </div>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-md-offset-3">
                    <canvas id="myChart" width="200" height="200"<?php if ($_admin or $_superv): ?> style="display: none"<?php endif ?>></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="results/competitive-profile.js"></script>
