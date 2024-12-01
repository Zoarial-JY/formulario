<?=$cabecera ?>

<div class="short-container d-flex justify-content-center align-items-center border border-top-0  contenedor-inicio">
    <div class="btn-contenedor">
        <h2 class="text-center bienvenido">Bienvenido</h2>

        <a class="btn btn-warning btn-bienvenido" href="<?=base_url('iniciosesion'); ?>">Iniciar sesion</a>

        <a class="btn btn-warning btn-bienvenido" href="<?=base_url('iniciosesion'); ?>">Registrarse</a>
    </div>  
</div>

<style>
    .short-container {
      height: 80%; /* Ajusta esta altura según tus necesidades */
      background-color: #f8f9fa; /* Color de fondo para distinguir el contenedor */
    }
    .full-height {
      height: 100vh; /* Altura completa de la ventana */
    }

    .btn-contenedor{
        display:grid;
        grid-template-columns: 1fr 1fr;
        gap: 65px;
    }
    .bienvenido{
        grid-column: 1/3;
    }

    .btn-bienvenido{
        padding: 40px 55px;
        font-size: 25px;
        font-weight: bold;
        background-color: grey;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<?=$pie ?>