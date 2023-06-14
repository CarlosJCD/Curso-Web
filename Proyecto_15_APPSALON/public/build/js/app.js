let paso=1;const pasoInicial=1,pasoFinal=3,BASE_DIR="/Curso-Web/Proyecto_15_APPSALON/public/index.php",cita={nombre:"",fecha:"",hora:"",servicios:[]};function main(){mostrarSeccion(),cambiarSeccionSegunElTab(),botonesDelPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI(),obtenerNombreCliente(),obtenerFechaCita(),obtenerHoraCita(),mostrarResumenCita()}function cambiarSeccionSegunElTab(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesDelPaginador()}))})}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");document.querySelector("#paso-"+paso).classList.add("mostrar");document.querySelector(".actual").classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function botonesDelPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");switch(paso){case 1:e.classList.add("ocultar"),t.classList.remove("ocultar");break;case 2:e.classList.remove("ocultar"),t.classList.remove("ocultar");break;case 3:e.classList.remove("ocultar"),t.classList.add("ocultar"),mostrarResumenCita()}mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=1||(paso--,botonesDelPaginador())}))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=3||(paso++,botonesDelPaginador())}))}async function consultarAPI(){try{const e="https://localhost/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach(e=>{const{id:t,nombre:o,precio:n}=e,a=document.createElement("P");a.classList.add("nombre-servicio"),a.textContent=o;const r=document.createElement("P");r.classList.add("precio-servicio"),r.textContent="$"+n;const c=document.createElement("DIV");c.classList.add("servicio"),c.dataset.idServicio=t,c.onclick=function(){seleccionarServicio(e)},c.appendChild(a),c.appendChild(r),document.querySelector("#servicios").appendChild(c)})}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,n=document.querySelector(`[data-id-servicio="${e.id}"]`);o.some(t=>t.id===e.id)?(cita.servicios=o.filter(e=>e.id!==t),n.classList.remove("seleccionado")):(cita.servicios.push(e),n.classList.add("seleccionado"))}function obtenerNombreCliente(){cita.nombre=document.querySelector("#nombre").value}function obtenerFechaCita(){document.querySelector("#fecha").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",mostrarAlerta("Fines de semana no permitidos","error",".formulario")):cita.fecha=e.target.value}))}function obtenerHoraCita(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value.split(":")[0];t<10||t>18?(e.target.value="",mostrarAlerta("Horario de trabajo: 10:00 a 18:00 horas","error",".formulario")):cita.hora=e.target.value}))}function mostrarResumenCita(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void mostrarAlerta("Faltan datos de Servicios, Fecha u Hora","error",".contenido-resumen",!1);const{nombre:t,fecha:o,hora:n,servicios:a}=cita,r=document.createElement("H3");r.textContent="Resumen de Servicios",e.appendChild(r),desplegarServiciosEnElResumen(a,e);const c=document.createElement("H3");c.textContent="Resumen de Cita",e.appendChild(c);const i=document.createElement("P");i.innerHTML="<span>Nombre:</span> "+t;const s=formatearFecha(o),d=document.createElement("P");d.innerHTML="<span>Fecha:</span> "+s;const l=document.createElement("P");l.innerHTML=`<span>Hora:</span> ${n} Horas`;const u=document.createElement("BUTTON");u.classList.add("boton"),u.textContent="Reservar Cita",u.onclick=reservarCita,e.appendChild(i),e.appendChild(d),e.appendChild(l),e.appendChild(u)}function desplegarServiciosEnElResumen(e,t){e.forEach(e=>{const{id:o,precio:n,nombre:a}=e,r=document.createElement("DIV");r.classList.add("contenedor-servicio");const c=document.createElement("P");c.textContent=a;const i=document.createElement("P");i.innerHTML="<span>Precio:</span> $"+n,r.appendChild(c),r.appendChild(i),t.appendChild(r)})}function formatearFecha(e){const t=new Date(e),o=t.getMonth(),n=t.getDate()+2,a=t.getFullYear();return new Date(Date.UTC(a,o,n)).toLocaleDateString("es-MX",{weekday:"long",year:"numeric",month:"long",day:"numeric"})}function reservarCita(){(new FormData).append()}function mostrarAlerta(e,t,o,n=!0){const a=document.querySelector(".alerta");a&&a.remove();const r=document.createElement("DIV");r.textContent=e,r.classList.add("alerta"),r.classList.add(t);document.querySelector(o).appendChild(r),n&&setTimeout(()=>{r.remove()},3e3)}document.addEventListener("DOMContentLoaded",(function(){main()}));