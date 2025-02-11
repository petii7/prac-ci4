<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css\styles.css">
    <title>CSNades - Inicio</title>
</head>
<body>
    <header>
        <h1><span class="letras-blancas">CS</span><span class="letras-azules">Nades</span></h1>
    </header>
    <main>
        <div id="opciones">
            <div class="opcion utilidad" onclick="window.location.href='<?= base_url('mapas'); ?>'"><span class="texto-opcion">UTILIDAD</span></div>
            <div class="opcion pizarra"><span class="texto-opcion">PIZARRA</span></div>
            <div class="opcion comunidad"><span class="texto-opcion">COMUNIDAD</span></div>
        </div>
        <h2>'Gana con cabeza, no solo con balas'</h2>
        <div id="unete-a-nosotros">
            <p>¡Únete a nuestra comunidad!</p>
            <a href="registro">Unirse</a>
        </div>
    </main>
</body>
</html>