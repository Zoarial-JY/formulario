<?=$cabecera ?>

    Formulario de editar

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Ingresar datos del usuario</h5>
        <p class="card-text">
            <form method="post" action="<?= site_url('/actualizar'); ?>" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?=$usuario['id']; ?>">

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" value="<?=$usuario['nombre']; ?>" class="form-control" type="text" name="nombre">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" value="<?=$usuario['email']; ?>" class="form-control" type="text" name="email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" value="<?=$usuario['password']; ?>" class="form-control" type="password" name="password">
                </div>

                <button class="btn btn-success" type="submit">Guardar</button>
            </form>
        </p>
    </div>
</div>

<?=$pie ?>    



