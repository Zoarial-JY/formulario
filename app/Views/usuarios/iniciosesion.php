<?=$cabecera ?>

    <div class="container full-height">
        <!-- Mostrar mensajes de error -->
        <?php if (session()->has('error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session('error') ?>
            </div>
        <?php endif; ?>


        <form method="post" action="<?= site_url('/ingresar'); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" class="form-control" type="email" name="email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" class="form-control" type="password" name="password">
            </div>

            <button class="btn btn-success" type="submit">Ingresar</button>

        </form>
    </div>

    <style>
        .full-height{
            height: 100vh; /* Altura completa de la ventana */ 
        }
    </style>

<?=$pie ?>