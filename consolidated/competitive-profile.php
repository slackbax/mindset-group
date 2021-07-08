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
                        <?php foreach ($profile as $pi => $pp): ?>
                            <tr>
                                <td><?php echo $pi + 1 . '. ' . $pp ?></td>
                                <?php $preg = [1, 2, 3, 4] ?>
                                <?php foreach ($preg as $i => $p): ?>
                                    <td class="text-center"></td>
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
                        <?php foreach ($profile as $pi => $pp): ?>
                            <tr>
                                <td><?php echo $pi + 1 . '. ' . $pp ?></td>
                                <?php $preg = [1, 2, 3, 4] ?>
                                <?php foreach ($preg as $i => $p): ?>
                                    <td class="text-center"></td>
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
                        <?php foreach ($profile as $pi => $pp): ?>
                            <tr class="text-center">
                                <td class="text-bold"><?php echo $pi + 1 ?></td>
                                <?php $preg = [1, 2, 3, 4] ?>
                                <?php foreach ($preg as $i): ?>
                                    <td></td>
                                    <td></td>
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
                    <canvas id="myChart" width="200" height="200" style="display: none"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="consolidated/competitive-profile.js"></script>
