<?php include 'class/User.php' ?>
<?php include 'class/Prueba.php' ?>
<?php include 'class/Pregunta.php' ?>
<?php include 'class/Examen.php' ?>
<?php $us = new User() ?>
<?php $pru = new Prueba() ?>
<?php $pre = new Pregunta() ?>
<?php $exa = new Examen() ?>
<?php $pr = $pru->get(6) ?>
<?php if (!$_admin and !$_superv): ?>
    <?php $ex = $exa->getByUserTestType($_SESSION['msg_userid'], 6) ?>
<?php endif ?>

<section class="content-header">
    <h1>Instrumentos
        <small>Enfoque estratégico</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Enfoque estratégico</li>
    </ol>
</section>

<section class="content container-fluid">
    <form role="form" id="formNewTest">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Enfoque Estratégico</h3>
            </div>

            <?php if ($_admin or $_superv or $us->getHasInstrument($_SESSION['msg_userid'], 6)): ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-8">
                            <input type="hidden" name="ipid" value="6">
                            <?php echo $pr->pru_introduccion ?>
                        </div>
                    </div>
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
                        <?php $ind = 'A' ?>
                        <?php $ind_p = 1 ?>
                        <?php $preg = 1 ?>
                        <?php $al = $pre->getByPrueba(6) ?>
                        <?php foreach ($al as $i => $v): ?>
                            <?php switch ($ind_p):
                                case 1:
                                    echo '<p class="text-bold">I - Prácticas actuales de elaboración de estrategias</p>';
                                    echo '<p>Seleccione una declaración que describa mejor sus prácticas actuales de elaboración de estrategias:</p>';
                                    break;
                                case 6:
                                    echo '<p class="text-bold" style="margin-top: 15px">II - Percepción de su entorno empresarial</p>';
                                    echo '<p>Seleccione una declaración que describa mejor la percepción que posee del entorno:</p>';
                                    $preg++;
                                    break;
                                case 11:
                                    echo '<p class="text-bold" style="margin-top: 15px">III - Enfoque de estrategia previsto</p>';
                                    echo '<p>Seleccione una declaración que describa mejor sus prácticas actuales de elaboración de estrategias:</p>';
                                    $preg++;
                                    break;
                                default:
                                    break;
                            endswitch ?>
                            <div class="row" style="margin-top: 20px">
                                <div class="col-xs-12">
                                    <label style="font-weight: normal">
                                        <input class="minimal" type="radio" name="pr[<?php echo $preg ?>]" id="pr_<?php echo $v->pre_id ?>" value="<?php echo $v->pre_id ?>" required> <?php echo $v->pre_descripcion ?>
                                    </label>
                                </div>
                            </div>
                            <?php $ind++ ?>
                            <?php $ind_p++ ?>
                        <?php endforeach ?>
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

<script src="instruments/strategic-focus.js"></script>
