//fetch API


async function obtenerEmpleados() {
    const direccionArchivo = "empleados.json"
    // fetch(direccionArchivo)
    //     .then(resultado => resultado.json())
    //     .then(datos => {
    //         const { empleados } = datos;
    //         empleados.forEach(empleado => {
    //             console.log(empleado);
    //         })
    //     })
    const resultado = await fetch(direccionArchivo);
    const datos = await resultado.json();
    console.log(datos);
}
obtenerEmpleados();