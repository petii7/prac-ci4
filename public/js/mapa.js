// Inicializar el mapa en un div con ID "mapa"
var mapa = L.map('mapa-utilidad', {
    crs: L.CRS.Simple, // Esto permite usar imágenes en lugar de mapas geográficos
    minZoom: -2, 
    maxZoom: 2
});

// Cargar la imagen del mapa del juego como fondo
var bounds = [[0, 0], [1000, 1000]]; // Ajusta los límites según el tamaño de tu imagen
L.imageOverlay('<?= base_url("css/images/inferno-mapa.png") ?>', bounds).addTo(mapa);
mapa.fitBounds(bounds);

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
utilidades.forEach(utilidad => {
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

    utilidades.forEach(utilidad => {
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
