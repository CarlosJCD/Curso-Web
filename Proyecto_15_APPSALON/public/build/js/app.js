let paso=1;const pasoInicial=1,pasoFinal=3,BASE_DIR="/Curso-Web/Proyecto_15_APPSALON/public/index.php",cita={nombre:"",fecha:"",hora:"",servicios:[]};function main(){mostrarSeccion(paso),cambiarSeccionSegunElTab(),botonesDelPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI()}function cambiarSeccionSegunElTab(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesDelPaginador()}))})}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");document.querySelector("#paso-"+paso).classList.add("mostrar");document.querySelector(".actual").classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function botonesDelPaginador(){const e=document.querySelector("#anterior"),o=document.querySelector("#siguiente");switch(paso){case 1:e.classList.add("ocultar"),o.classList.remove("ocultar");break;case 2:e.classList.remove("ocultar"),o.classList.remove("ocultar");break;case 3:e.classList.remove("ocultar"),o.classList.add("ocultar")}mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=1||(paso--,botonesDelPaginador())}))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=3||(paso++,botonesDelPaginador())}))}async function consultarAPI(){try{const e="http://localhost"+BASE_DIR+"/api/servicios",o=await fetch(e);mostrarServicios(await o.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach(e=>{const{id:o,nombre:t,precio:c}=e,a=document.createElement("P");a.classList.add("nombre-servicio"),a.textContent=t;const i=document.createElement("P");i.classList.add("precio-servicio"),i.textContent="$"+c;const s=document.createElement("DIV");s.classList.add("servicio"),s.dataset.idServicio=o,s.onclick=function(){seleccionarServicio(e)},s.appendChild(a),s.appendChild(i),document.querySelector("#servicios").appendChild(s)})}function seleccionarServicio(e){const{id:o}=e,{servicios:t}=cita,c=document.querySelector(`[data-id-servicio="${e.id}"]`);t.some(o=>o.id===e.id)?(cita.servicios=t.filter(e=>e.id!==o),c.classList.remove("seleccionado")):(cita.servicios.push(e),c.classList.add("seleccionado"))}document.addEventListener("DOMContentLoaded",(function(){main()}));