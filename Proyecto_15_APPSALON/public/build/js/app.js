let paso=1;const pasoInicial=1,pasoFinal=3,BASE_DIR="/Curso-Web/Proyecto_15_APPSALON/public/index.php",cita={nombre:"",fecha:"",hora:"",servicios:[]};function main(){mostrarSeccion(),cambiarSeccionSegunElTab(),botonesDelPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI(),obtenerNombreCliente(),obtenerFechaCita()}function cambiarSeccionSegunElTab(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesDelPaginador()}))})}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");document.querySelector("#paso-"+paso).classList.add("mostrar");document.querySelector(".actual").classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function botonesDelPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");switch(paso){case 1:e.classList.add("ocultar"),t.classList.remove("ocultar");break;case 2:e.classList.remove("ocultar"),t.classList.remove("ocultar");break;case 3:e.classList.remove("ocultar"),t.classList.add("ocultar")}mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=1||(paso--,botonesDelPaginador())}))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=3||(paso++,botonesDelPaginador())}))}async function consultarAPI(){try{const e="http://localhost"+BASE_DIR+"/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach(e=>{const{id:t,nombre:o,precio:a}=e,c=document.createElement("P");c.classList.add("nombre-servicio"),c.textContent=o;const n=document.createElement("P");n.classList.add("precio-servicio"),n.textContent="$"+a;const i=document.createElement("DIV");i.classList.add("servicio"),i.dataset.idServicio=t,i.onclick=function(){seleccionarServicio(e)},i.appendChild(c),i.appendChild(n),document.querySelector("#servicios").appendChild(i)})}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,a=document.querySelector(`[data-id-servicio="${e.id}"]`);o.some(t=>t.id===e.id)?(cita.servicios=o.filter(e=>e.id!==t),a.classList.remove("seleccionado")):(cita.servicios.push(e),a.classList.add("seleccionado"))}function obtenerNombreCliente(){cita.nombre=document.querySelector("#nombre").value}function obtenerFechaCita(){document.querySelector("#fecha").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",mostrarAlerta("Fines de semana no permitidos","error",".formulario")):cita.fecha=e.target.value}))}function mostrarAlerta(e,t,o,a=!0){const c=document.querySelector(".alerta");c&&c.remove();const n=document.createElement("DIV");n.textContent=e,n.classList.add("alerta"),n.classList.add(t);document.querySelector(o).appendChild(n),a&&setTimeout(()=>{n.remove()},3e3)}document.addEventListener("DOMContentLoaded",(function(){main()}));