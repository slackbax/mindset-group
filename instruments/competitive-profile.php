<?php include 'class/User.php' ?>
<?php include 'class/Prueba.php' ?>
<?php include 'class/Pregunta.php' ?>
<?php include 'class/Examen.php' ?>
<?php $us = new User() ?>
<?php $pru = new Prueba() ?>
<?php $pre = new Pregunta() ?>
<?php $exa = new Examen() ?>
<?php $pr = $pru->get(4) ?>
<?php if (!$_admin and !$_superv): ?>
    <?php $ex = $exa->getByUserTestType($_SESSION['msg_userid'], 4) ?>
<?php endif ?>

<section class="content-header">
    <h1>Instrumentos
        <small>Perfil competitivo</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Perfil competitivo</li>
    </ol>
</section>

<section class="content container-fluid">
    <form role="form" id="formNewTest">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Perfil Competitivo</h3>
            </div>

            <?php if ($_admin or $_superv or $us->getHasInstrument($_SESSION['msg_userid'], 4)): ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-8">
                            <input type="hidden" name="ipid" value="4">
                            <?php echo $pr->pru_introduccion ?>
                        </div>

                        <div class="col-sm-6">
                            <table class="table table-bordered">
                                <tr class="bg-gray-light">
                                    <th class="text-center" colspan="2">Actual</th>
                                    <th class="text-center" colspan="2">Deseado</th>
                                </tr>
                                <tr class="text-center">
                                    <td>A</td>
                                    <td>50</td>
                                    <td>A</td>
                                    <td>40</td>
                                </tr>
                                <tr class="text-center">
                                    <td>B</td>
                                    <td>10</td>
                                    <td>B</td>
                                    <td>20</td>
                                </tr>
                                <tr class="text-center">
                                    <td>C</td>
                                    <td>30</td>
                                    <td>C</td>
                                    <td>20</td>
                                </tr>
                                <tr class="text-center">
                                    <td>D</td>
                                    <td>10</td>
                                    <td>D</td>
                                    <td>20</td>
                                </tr>
                                <tr>
                                    <th class="text-center">Total</th>
                                    <th class="text-center text-green">100</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center text-green">100</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="box-header with-border">
                    <h3 class="box-title">Evaluación del Perfil Competitivo</h3>
                </div>

                <?php if (!$_admin and !$_superv and !is_null($ex->exa_id)): ?>
                    <div class="box-body">
                        <div class="alert alert-danger">
                            <h4><i class="icon fa fa-ban"></i> Error!</h4>
                            Usted ya ha completado este instrumento. Por favor, escoja un instrumento distinto o comuníquese con el administrador, si considera que existe algún error.
                        </div>
                    </div>
                <?php else: ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="bg-gray">
                                        <th class="text-center">Opción</th>
                                        <th class="text-center">Item</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <!-- CARACTERISTICAS DOMINANTES -->
                                    <tr class="bg-gray-light text-center text-bold">
                                        <td>1</td>
                                        <td>Características Dominantes (CD)</td>
                                        <td class="text-red">Perfil Actual</td>
                                        <td class="text-blue">Perfil Deseado</td>
                                    </tr>
                                    <?php $l = 'A'; ?>
                                    <?php for ($i = 1; $i < 5; $i++): ?>
                                        <tr>
                                            <?php $p = $pre->getByPruebaNumero(4, $i) ?>
                                            <td class="text-center"><?php echo $l ?></td>
                                            <td><?php echo $p->pre_descripcion ?></td>
                                            <td><input class="form-control input-number valor pa-cd" id="pa_<?php echo $p->pre_id ?>_cd" name="pa[<?php echo $p->pre_id ?>]"></td>
                                            <td><input class="form-control input-number valor pd-cd" id="pd_<?php echo $p->pre_id ?>_cd" name="pd[<?php echo $p->pre_id ?>]"></td>
                                            <?php $l++ ?>
                                        </tr>
                                    <?php endfor ?>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">Total Características Dominantes (CD)</th>
                                        <th><input class="form-control input-number total" id="pa_cd" value="0" disabled></th>
                                        <th><input class="form-control input-number total" id="pd_cd" value="0" disabled></th>
                                    </tr>
                                    <!-- LIDER DE LA ORGANIZACION -->
                                    <tr class="bg-gray-light text-center text-bold">
                                        <td>2</td>
                                        <td>Líder de la Organización (LO)</td>
                                        <td class="text-red">Perfil Actual</td>
                                        <td class="text-blue">Perfil Deseado</td>
                                    </tr>
                                    <?php $l = 'A'; ?>
                                    <?php for ($i = 5; $i < 9; $i++): ?>
                                        <tr>
                                            <?php $p = $pre->getByPruebaNumero(4, $i) ?>
                                            <td class="text-center"><?php echo $l ?></td>
                                            <td><?php echo $p->pre_descripcion ?></td>
                                            <td><input class="form-control input-number valor pa-lo" id="pa_<?php echo $p->pre_id ?>_lo" name="pa[<?php echo $p->pre_id ?>]"></td>
                                            <td><input class="form-control input-number valor pd-lo" id="pd_<?php echo $p->pre_id ?>_lo" name="pd[<?php echo $p->pre_id ?>]"></td>
                                            <?php $l++ ?>
                                        </tr>
                                    <?php endfor ?>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">Total Líder de la Organización (LO)</th>
                                        <th><input class="form-control input-number total" id="pa_lo" value="0" disabled></th>
                                        <th><input class="form-control input-number total" id="pd_lo" value="0" disabled></th>
                                    </tr>
                                    <!-- DIRECCION DE LOS COLABORADORES -->
                                    <tr class="bg-gray-light text-center text-bold">
                                        <td>3</td>
                                        <td>Dirección de los Colaboradores (DC)</td>
                                        <td class="text-red">Perfil Actual</td>
                                        <td class="text-blue">Perfil Deseado</td>
                                    </tr>
                                    <?php $l = 'A'; ?>
                                    <?php for ($i = 9; $i < 13; $i++): ?>
                                        <tr>
                                            <?php $p = $pre->getByPruebaNumero(4, $i) ?>
                                            <td class="text-center"><?php echo $l ?></td>
                                            <td><?php echo $p->pre_descripcion ?></td>
                                            <td><input class="form-control input-number valor pa-dc" id="pa_<?php echo $p->pre_id ?>_dc" name="pa[<?php echo $p->pre_id ?>]"></td>
                                            <td><input class="form-control input-number valor pd-dc" id="pd_<?php echo $p->pre_id ?>_dc" name="pd[<?php echo $p->pre_id ?>]"></td>
                                            <?php $l++ ?>
                                        </tr>
                                    <?php endfor ?>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">Total Dirección de los Colaboradores (DC)</th>
                                        <th><input class="form-control input-number total" id="pa_dc" value="0" disabled></th>
                                        <th><input class="form-control input-number total" id="pd_dc" value="0" disabled></th>
                                    </tr>
                                    <!-- UNIDAD ORGANIZACIONAL -->
                                    <tr class="bg-gray-light text-center text-bold">
                                        <td>4</td>
                                        <td>Unidad Organizacional (UO)</td>
                                        <td class="text-red">Perfil Actual</td>
                                        <td class="text-blue">Perfil Deseado</td>
                                    </tr>
                                    <?php $l = 'A'; ?>
                                    <?php for ($i = 13; $i < 17; $i++): ?>
                                        <tr>
                                            <?php $p = $pre->getByPruebaNumero(4, $i) ?>
                                            <td class="text-center"><?php echo $l ?></td>
                                            <td><?php echo $p->pre_descripcion ?></td>
                                            <td><input class="form-control input-number valor pa-uo" id="pa_<?php echo $p->pre_id ?>_uo" name="pa[<?php echo $p->pre_id ?>]"></td>
                                            <td><input class="form-control input-number valor pd-uo" id="pd_<?php echo $p->pre_id ?>_uo" name="pd[<?php echo $p->pre_id ?>]"></td>
                                            <?php $l++ ?>
                                        </tr>
                                    <?php endfor ?>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">Total Unidad Organizacional (UO)</th>
                                        <th><input class="form-control input-number total" id="pa_uo" value="0" disabled></th>
                                        <th><input class="form-control input-number total" id="pd_uo" value="0" disabled></th>
                                    </tr>
                                    <!-- ENFASIS ESTRATEGICO -->
                                    <tr class="bg-gray-light text-center text-bold">
                                        <td>5</td>
                                        <td>Énfasis Estratégico (EE)</td>
                                        <td class="text-red">Perfil Actual</td>
                                        <td class="text-blue">Perfil Deseado</td>
                                    </tr>
                                    <?php $l = 'A'; ?>
                                    <?php for ($i = 17; $i < 21; $i++): ?>
                                        <tr>
                                            <?php $p = $pre->getByPruebaNumero(4, $i) ?>
                                            <td class="text-center"><?php echo $l ?></td>
                                            <td><?php echo $p->pre_descripcion ?></td>
                                            <td><input class="form-control input-number valor pa-ee" id="pa_<?php echo $p->pre_id ?>_ee" name="pa[<?php echo $p->pre_id ?>]"></td>
                                            <td><input class="form-control input-number valor pd-ee" id="pd_<?php echo $p->pre_id ?>_ee" name="pd[<?php echo $p->pre_id ?>]"></td>
                                            <?php $l++ ?>
                                        </tr>
                                    <?php endfor ?>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">Total Énfasis Estratégico (EE)</th>
                                        <th><input class="form-control input-number total" id="pa_ee" value="0" disabled></th>
                                        <th><input class="form-control input-number total" id="pd_ee" value="0" disabled></th>
                                    </tr>
                                    <!-- CRITERIOS DE EXITO -->
                                    <tr class="bg-gray-light text-center text-bold">
                                        <td>6</td>
                                        <td>Criterios de Éxito (CE)</td>
                                        <td class="text-red">Perfil Actual</td>
                                        <td class="text-blue">Perfil Deseado</td>
                                    </tr>
                                    <?php $l = 'A'; ?>
                                    <?php for ($i = 21; $i < 25; $i++): ?>
                                        <tr>
                                            <?php $p = $pre->getByPruebaNumero(4, $i) ?>
                                            <td class="text-center"><?php echo $l ?></td>
                                            <td><?php echo $p->pre_descripcion ?></td>
                                            <td><input class="form-control input-number valor pa-ce" id="pa_<?php echo $p->pre_id ?>_ce" name="pa[<?php echo $p->pre_id ?>]"></td>
                                            <td><input class="form-control input-number valor pd-ce" id="pd_<?php echo $p->pre_id ?>_ce" name="pd[<?php echo $p->pre_id ?>]"></td>
                                            <?php $l++ ?>
                                        </tr>
                                    <?php endfor ?>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">Total Criterios de Éxito (CE)</th>
                                        <th><input class="form-control input-number total" id="pa_ce" value="0" disabled></th>
                                        <th><input class="form-control input-number total" id="pd_ce" value="0" disabled></th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="btnsubmit"><i class="fa fa-check"></i> Guardar respuestas</button>
                        <button type="reset" class="btn btn-default" id="btnClear">Limpiar</button>
                        <i class="ajaxLoader fa fa-cog fa-spin" id="submitLoader"></i>
                    </div>
                <?php endif ?>
            <?php else: ?>
                <div class="box-body">
                    <div class="callout callout-danger">
                        <h4><i class="fa fa-times"></i> Error de acceso</h4>
                        <p>Ha intentado ingresar a un instrumento restringido. Si considera que debiera tener acceso, contacte con el administrador para mayor información.</p>
                        <a class="btn btn-warning" id="btnback"><i class="fa fa-undo"></i> Volver atrás</a> <a href="index.php" class="btn btn-info" id="btnback"><i class="fa fa-home"></i> Volver al inicio</a>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </form>
</section>

<script src="instruments/competitive-profile.js"></script>