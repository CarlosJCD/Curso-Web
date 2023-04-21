// Async Await

function descargarNuevosClientes() {
    return new Promise(resolve => {
        console.log('Descargando clientes... espere...');

        setTimeout(() => {
            resolve('Los Clientes fueron Descargados');
        }, 5000);
    });
}

async function app() {
    try {
        const resultado = await descargarNuevosClientes();
        console.log('Este codigo si se bloquea');
        console.log(resultado);
    } catch (error) {
        console.log(error)
    }
}

app();

console.log('Este codigo no se bloquea');