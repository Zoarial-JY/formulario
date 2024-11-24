<?=$cabecera ?>

<!--<a class="btn btn-success" href="<base_url('crear'); ?">Crear un nuevo usuario</a>
<br/>
<br/>

<a class="btn btn-primary" href="?=base_url('iniciosesion'); ?">Iniciar sesion</a> -->


        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>E-mail</th>
                    <th>Password</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <?php foreach ($usuarios as $usuario): ?>

            <tbody>
                <tr>
                    <td><?= $usuario['id'];?></td>
                    <td><?= $usuario['nombre'];?></td>
                    <td><?= $usuario['email'];?></td>
                    <td><?= $usuario['password'];?></td>
                    <td>
                        <a href="<?=base_url('editar/'.$usuario['id']); ?>" class="btn btn-info" type="button">Editar</a>

                        <a href="<?=base_url('borrar/'.$usuario['id']); ?>" class="btn btn-danger" type="button">Borrar</a>
                    </td>
                </tr>
            </tbody>

            <?php endforeach; ?>

        </table>

<a href="<?= site_url('/exportExcel'); ?>"  class="btn btn-success" type="button">Excel</a>
<a href="<?= site_url('/exportWord'); ?>"  class="btn btn-primary" type="button">Word</a>
<a href="<?= site_url('/exportPdf'); ?>"  class="btn btn-danger" type="button">PDF</a>

<?=$pie ?>
