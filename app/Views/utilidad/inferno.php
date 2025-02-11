<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... tus etiquetas HEAD ... -->
    <link rel="stylesheet" href="<?= base_url('libs/leaflet/leaflet.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
    <script src="<?= base_url('libs/leaflet/leaflet.js') ?>"></script>
    <title>CSNades - Inferno</title>
</head>
<body>
    <header>
        <h1><span class="letras-blancas">CS</span><span class="letras-azules">Nades</span></h1>
    </header>
    <main>
        <h2>Inferno</h2>
        <div id="mapa-utilidad"></div>
        <select id="filtroUtilidad">
            <option value="todas">Todas</option>
            <option value="humo">Humos</option>
            <option value="molotov">Molotovs</option>
            <option value="flash">Flashes</option>
        </select>
    </main>
    
    <!-- Coloca el script al final para asegurar que el DOM ya está cargado -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener el contenedor del mapa
        var container = document.getElementById("mapa-utilidad");
        var width = container.offsetWidth;
        var height = container.offsetHeight;
        
        // Inicializar el mapa en el div con ID "mapa-utilidad"
        var mapa = L.map('mapa-utilidad', {
            crs: L.CRS.Simple // Permite usar imágenes en lugar de mapas geográficos
        });
        
        // Definir los bounds en función del tamaño del contenedor
        // Recordar que Leaflet utiliza el formato [ [y, x], [y, x] ]
        var bounds = [[0, 0], [height, width]];
        
        // Cargar la imagen del mapa como fondo (la imagen se estirará para llenar el contenedor)
        L.imageOverlay('<?= base_url("css/images/inferno-mapa.png") ?>', bounds).addTo(mapa);
        mapa.fitBounds(bounds);
        
        // Opcional: Actualizar el tamaño del mapa al redimensionar la ventana
        window.addEventListener("resize", function() {
            // Actualizar los bounds basados en el nuevo tamaño del contenedor
            var newWidth = container.offsetWidth;
            var newHeight = container.offsetHeight;
            var newBounds = [[0, 0], [newHeight, newWidth]];
            mapa.eachLayer(function(layer) {
                // Si es el imageOverlay, actualizar la imagen (o remover y volver a agregarla)
                if (layer instanceof L.ImageOverlay) {
                    layer.setBounds(newBounds);
                }
            });
            mapa.fitBounds(newBounds);
            mapa.invalidateSize();
        });
        
        // Datos de utilidad (posición donde cae y desde dónde se lanza)
        var utilidades = [
            {
                tipo: "humo",
                posicionCae: [500, 700], // Coordenadas de donde cae
                posicionLanza: [300, 200], // Coordenadas de donde se lanza
                urlReferencia: "detalle/humo-ct" // Página de referencia
            },
            {
                tipo: "molotov",
                posicionCae: [600, 500],
                posicionLanza: [350, 250],
                urlReferencia: "detalle/molotov-ninja"
            }
        ];
        
        // Íconos personalizados
        var iconos = {
            "humo": L.icon({ iconUrl: '<?= base_url("css/images/smoke-icono.webp") ?>', iconSize: [32, 32] }),
            "molotov": L.icon({ iconUrl: '<?= base_url("css/images/molotov-icono.webp") ?>', iconSize: [32, 32] }),
            "flash": L.icon({ iconUrl: '<?= base_url("css/images/flash-icono.webp") ?>', iconSize: [32, 32] })
        };
        
        // Agregar marcadores de utilidad
        utilidades.forEach(function(utilidad) {
            var marcadorCae = L.marker(utilidad.posicionCae, { icon: iconos[utilidad.tipo] }).addTo(mapa);
            marcadorCae.on("click", function () {
                // Dibujar línea desde el punto de lanzamiento
                var linea = L.polyline([utilidad.posicionCae, utilidad.posicionLanza], { color: 'red' }).addTo(mapa);
                
                // Marcar el punto de lanzamiento
                var marcadorLanza = L.marker(utilidad.posicionLanza).addTo(mapa);
                marcadorLanza.on("click", function () {
                    window.location.href = utilidad.urlReferencia; // Redirigir a la referencia
                });
            });
        });
        
        // Filtrar según la selección
        document.getElementById("filtroUtilidad").addEventListener("change", function() {
            var tipoSeleccionado = this.value;
        
            mapa.eachLayer(function (layer) {
                if (layer instanceof L.Marker || layer instanceof L.Polyline) {
                    mapa.removeLayer(layer);
                }
            });
        
            utilidades.forEach(function(utilidad) {
                if (tipoSeleccionado === "todas" || utilidad.tipo === tipoSeleccionado) {
                    var marcadorCae = L.marker(utilidad.posicionCae, { icon: iconos[utilidad.tipo] }).addTo(mapa);
                    marcadorCae.on("click", function () {
                        var linea = L.polyline([utilidad.posicionCae, utilidad.posicionLanza], { color: 'red' }).addTo(mapa);
                        var marcadorLanza = L.marker(utilidad.posicionLanza).addTo(mapa);
                        marcadorLanza.on("click", function () {
                            window.location.href = utilidad.urlReferencia;
                        });
                    });
                }
            });
        });
    });
    </script>

</body>
</html>
