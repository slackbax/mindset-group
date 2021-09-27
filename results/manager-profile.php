<?php include 'class/User.php' ?>
<?php $us = new User() ?>

<section class="content-header">
    <h1>Resultados
        <small>Perfil gerencial</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Perfil gerencial</li>
    </ol>
</section>

<section class="content container-fluid">
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
                        <?php $u = $us->getByInstrument(5) ?>
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

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Resumen promedio de los Factores que definen el Perfil Gerencial</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table class="table table-bordered" id="table_result">
                        <tr class="bg-gray-light">
                            <td></td>
                            <th>FOCO INTERNO</th>
                            <th class="text-center"></th>
                            <th>FLEXIBILIDAD</th>
                            <th class="text-center"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th rowspan="5" class="text-center"><span style="writing-mode:vertical-rl;-ms-writing-mode:tb-rl;transform:rotate(180deg);">COLABORAR</span></th>
                            <td>Entendiéndome a mí y a otros</td>
                            <td class="text-center"></td>
                            <td>Usando el poder ética y efectivamente</td>
                            <td class="text-center"></td>
                            <th rowspan="5" class="text-center"><span style="writing-mode:vertical-rl;-ms-writing-mode:tb-rl;transform:rotate(180deg);">CREAR</span></th>
                        </tr>
                        <tr>
                            <td>Comunicándome honesta y efectivamente</td>
                            <td class="text-center"></td>
                            <td>Campeoneando y vendiendo nuevas ideas</td>
                            <td class="text-center"></td>
                        </tr>
                        <tr>
                            <td>Dando tutoría y desarrollando a otros</td>
                            <td class="text-center"></td>
                            <td>Promoviendo la innovación</td>
                            <td class="text-center"></td>
                        </tr>
                        <tr>
                            <td>Liderando equipos</td>
                            <td class="text-center"></td>
                            <td>Negociando acuerdos y compromisos</td>
                            <td class="text-center"></td>
                        </tr>
                        <tr>
                            <td>Manejando y alentando el conflicto</td>
                            <td class="text-center"></td>
                            <td>Impulsando y sosteniendo el cambio</td>
                            <td class="text-center"></td>
                        </tr>

                        <tr class="bg-gray-light">
                            <td></td>
                            <th>CONTROL</th>
                            <th class="text-center"></th>
                            <th>FOCO EXTERNO</th>
                            <th class="text-center"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th rowspan="5" class="text-center"><span style="writing-mode:vertical-rl;-ms-writing-mode:tb-rl;transform:rotate(180deg);">CONTROLAR</span></th>
                            <td>Organizando el flujo de información</td>
                            <td class="text-center"></td>
                            <td>Desarrollando y comunicando una visión</td>
                            <td class="text-center"></td>
                            <th rowspan="5" class="text-center"><span style="writing-mode:vertical-rl;-ms-writing-mode:tb-rl;transform:rotate(180deg);">COMPETIR</span></th>
                        </tr>
                        <tr>
                            <td>Trabajando y gestionalmente a traves de funciones</td>
                            <td class="text-center"></td>
                            <td>Fijando metas y objetivos</td>
                            <td class="text-center"></td>
                        </tr>
                        <tr>
                            <td>Planificando y coordinando proyectos</td>
                            <td class="text-center"></td>
                            <td>Motivándose y motivando a otros</td>
                            <td class="text-center"></td>
                        </tr>
                        <tr>
                            <td>Midiendo y monitreando calidad y desempeño</td>
                            <td class="text-center"></td>
                            <td>Diseñando y organizando</td>
                            <td class="text-center"></td>
                        </tr>
                        <tr>
                            <td>Alentando y posibiltando el cumplimiento</td>
                            <td class="text-center"></td>
                            <td>Manejando la ejecución y conduciendo resultados</td>
                            <td class="text-center"></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row" style="margin-top: 20px">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <canvas id="myChart" width="300" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="results/manager-profile.js"></script>