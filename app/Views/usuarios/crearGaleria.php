<?=$cabecera ?>
<h3>Formulario de crear galeria</h3>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Subir imagen</h5>
        <form method="post" action="<?= site_url('/guardarGaleria'); ?>" enctype="multipart/form-data">

            <div class="custom-file">
                <label for="imagen" class="custom-file-label">Imagen:</label>
                <input id="imagen" class="custom-file-input" type="file" name="imagen" accept="image/*" required>            
            </div>

            <button class="btn btn-success" type="submit">Guardar</button>
        </form>
    </div>
</div>

<script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("imagen").files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>

<?=$pie ?>