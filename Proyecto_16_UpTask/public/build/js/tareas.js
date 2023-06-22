!function(){const e={0:"Pendiente",1:"Completa"};let t=[],a=[];function n(e=!1,a={}){const n=document.createElement("DIV");n.classList.add("modal"),n.innerHTML=`\n        <form class="formulario nueva-tarea">\n            <legend>${e?"Editar nombre de la tarea":"Añade una nueva tarea"}</legend>\n            <div class="campo">\n                <label for="tarea">Tarea</label>\n                <input \n                type="text" \n                name="tarea" \n                placeholder=${a.nombre?"Edita la Tarea":"Añadir Tarea al Proyecto Actual"} \n                value = "${a.nombre?a.nombre:""}"\n                id="tarea" />\n            </div>\n            <div class="opciones">\n                <input type="submit" class="submit-nueva-tarea" value="${a.nombre?"Guardar Cambios":"Añadir Tarea"}">\n                <button type="button" class="cerrar-modal">Cancelar</button>\n            </div>\n        </form>\n        `,setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},0),n.addEventListener("click",(function(s){if(s.preventDefault(),s.target.classList.contains("cerrar-modal")){document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{n.remove()},500)}if(s.target.classList.contains("submit-nueva-tarea")){const n=document.querySelector("#tarea").value.trim();if(""===n)return void o("El Nombre de la tarea es Obligatorio","error",document.querySelector(".formulario legend"));e?(a.nombre=n,i(a)):async function(e){const a=new FormData;a.append("nombre",e),a.append("proyectoUrl",r());try{const n="/api/tarea",r=await fetch(n,{method:"POST",body:a}),i=await r.json();if(o(i.mensaje,i.tipo,document.querySelector(".formulario legend")),"exito"===i.tipo){const a=document.querySelector(".modal");setTimeout(()=>{a.remove()},3e3);const n={id:String(i.id),nombre:e,estado:0,proyectoId:i.proyectoId};t=[...t,n],c()}}catch(e){console.log(e)}}(n)}})),document.querySelector(".dashboard").appendChild(n)}function o(e,t,a){const n=document.querySelector(".alerta");n&&n.remove();const o=document.createElement("DIV");o.classList.add("alerta",t),o.textContent=e,a.parentElement.insertBefore(o,a.nextElementSibling),setTimeout(()=>{o.remove()},5e3)}function r(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).url}function c(){const o=document.querySelector("#listado-tareas");!function(e){for(;e.firstChild;)e.removeChild(e.firstChild)}(o);const s=a.length?a:t;0!==s.length?s.forEach(a=>{o.appendChild(function(a){const o=document.createElement("LI");return o.dataset.tareaId=a.id,o.classList.add("tarea"),o.appendChild(function(e){const t=document.createElement("P");return t.textContent=e.nombre,t.ondblclick=function(){n(!0,{...e})},t}(a)),o.appendChild(function(a){const n=document.createElement("DIV");return n.classList.add("opciones"),n.appendChild(function(t){const a=document.createElement("BUTTON");return a.classList.add("estado-tarea"),a.classList.add(""+e[t.estado].toLowerCase()),a.textContent=e[t.estado],a.dataset.estadoTarea=t.estado,a.ondblclick=function(){!function(e){nuevoEstado="0"===e.estado?"1":"0",e.estado=nuevoEstado,i(e)}({...t})},a}(a)),n.appendChild(function(e){const a=document.createElement("BUTTON");return a.classList.add("eliminar-tarea"),a.dataset.idTarea=e.id,a.textContent="Eliminar",a.ondblclick=function(){!function(e){Swal.fire({title:"¿Eliminar Tarea?",icon:"question",showCancelButton:!0,cancelButtonText:"No",confirmButtonText:"Si"}).then(a=>{a.isConfirmed&&async function(e){const{estado:a,id:n,nombre:o}=e,i=new FormData;i.append("id",n),i.append("nombre",o),i.append("estado",a),i.append("proyectoUrl",r());try{const e="/api/tarea/eliminar",a=await fetch(e,{method:"POST",body:i});"exito"===(await a.json()).tipo&&(Swal.fire("Tarea eliminada correctamente",`La tarea '${o}' ha sido eliminada.`,"success"),t=t.filter(e=>e.id!==n),c())}catch(e){console.log(e)}}(e)})}({...e})},a}(a)),n}(a)),o}(a))}):o.appendChild(function(){const e=document.createElement("LI");return e.textContent="No hay tareas por realizar",e.classList.add("no-tareas"),e}())}async function i(e){const{estado:a,id:n,nombre:o}=e,i=new FormData;i.append("id",n),i.append("nombre",o),i.append("estado",a),i.append("proyectoUrl",r());try{const e="/api/tarea/actualizar",r=await fetch(e,{method:"POST",body:i}),s=await r.json();if("exito"===s.tipo){Swal.fire(s.mensaje,s.mensaje,"success");const e=document.querySelector(".modal");console.log(e),e&&e.remove(),t=t.map(e=>(e.id===n&&(e.estado=a,e.nombre=o),e)),c()}}catch(e){}}function s(e){const n=e.target.value;switch(n){case"0":case"1":a=t.filter(e=>e.estado===n);break;default:a=[]}console.log(a),c()}!async function(){try{const e="/api/tareas?url="+r(),a=await fetch(e),n=await a.json();t=n.tareas,c()}catch(e){console.log(e)}}(),document.querySelector("#agregar-tarea").addEventListener("click",(function(){n()})),document.querySelectorAll('#filtros input[type="radio"]').forEach(e=>{e.addEventListener("input",s)})}();