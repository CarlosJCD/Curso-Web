//metodos de propiedad
const reproductor = {
    reproducir: function (id) {
        console.log("Reproduciendo Cancion con id " + id + "...")
    },
    pausar: function () {
        console.log("Pausando cancion...")
    }
}

reproductor.borrarCancion = function (id) {
    console.log(`Borrando cancion con id ${id} ...`)
}

reproductor.reproducir(2391920);
reproductor.pausar();
reproductor.borrarCancion(2901247);
