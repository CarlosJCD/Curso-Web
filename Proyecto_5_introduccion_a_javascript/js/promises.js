// Promesas

const usuarioAutenticado = new Promise((resolve, reject) => {
    const auth = true;

    if (auth) {
        resolve("Usuario Autenticado");
    } else {
        reject("Usuario No Autenticado");
    }
})

usuarioAutenticado.then(function (resultado) { console.log(resultado) }).catch(function (resultado) { console.log(resultado) });