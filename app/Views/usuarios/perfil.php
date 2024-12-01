<?=$cabecera ?>

<div class="container">
    <h2>Perfil de Usuario</h2>
    <p>Nombre: <?= session()->get('nombre') ?></p>
    <p>Email: <?= session()->get('email') ?></p>
    <!-- Puedes agregar más información del perfil aquí -->
    <a href="<?= site_url('inicio') ?>" class="btn btn-danger">Cerrar sesión</a>
</div>

<h3>Lista de imagenes</h3>
<br/>

<a class="btn btn-success" href="<?=base_url('crearGaleria'); ?>">Agregar imagen a la galeria</a>
<br/><br/>

<?php //MENSAJE DE ERROR/SUCCESS?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <?php foreach ($galleries as $gallery): ?>

    <tbody>
        <tr>
            <td><?= $gallery['id'];?></td>
            <td>
                <img class="img-thumbnail" 
                    src="<?=base_url()?>/uploads/<?= $gallery['imagen'];?>" 
                    width="100" alt=""
                >  
            </td>
            <td>
                <a href="<?=base_url('editar/'. $gallery['id']); ?>" class="btn btn-info" type="button">Editar</a>

                <a href="<?=base_url('borrarGaleria/' . $gallery['id']); ?>" class="btn btn-danger" type="button" onclick="return confirm('¿Estás seguro de que deseas borrar esta imagen?');">Borrar</a>
            </td>
        </tr>
    </tbody>

    <?php endforeach; ?>

</table>


<?=$pie ?>