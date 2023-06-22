!function(){const e={0:"Pendiente",1:"Completa"};let t=[];function a(){const e=document.createElement("DIV");e.classList.add("modal"),e.innerHTML='\n        <form class="formulario nueva-tarea">\n            <legend>Añade una nueva tarea</legend>\n            <div class="campo">\n                <label for="tarea">Tarea</label>\n                <input type="text" name="tarea" placeholder="Añadir tarea al proyecto actual" id="tarea" />\n            </div>\n            <div class="opciones">\n                <input type="submit" class="submit-nueva-tarea" value="Añadir Tarea">\n                <button type="button" class="cerrar-modal">Cancelar</button>\n            </div>\n        </form>',setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},0),e.addEventListener("click",(function(a){if(a.preventDefault(),a.target.classList.contains("cerrar-modal")){document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{e.remove()},500)}a.target.classList.contains("submit-nueva-tarea")&&function(){const e=document.querySelector("#tarea").value.trim();if(""===e)return void n("El Nombre de la tarea es Obligatorio","error",document.querySelector(".formulario legend"));!async function(e){const a=new FormData;a.append("nombre",e),a.append("proyectoUrl",o());try{const o="/api/tarea",c=await fetch(o,{method:"POST",body:a}),d=await c.json();if(n(d.mensaje,d.tipo,document.querySelector(".formulario legend")),"exito"===d.tipo){const a=document.querySelector(".modal");setTimeout(()=>{a.remove()},3e3);const n={id:String(d.id),nombre:e,estado:0,proyectoId:d.proyectoId};t=[...t,n],r()}}catch(e){console.log(e)}}(e)}()})),document.querySelector(".dashboard").appendChild(e)}function n(e,t,a){const n=document.querySelector(".alerta");n&&n.remove();const o=document.createElement("DIV");o.classList.add("alerta",t),o.textContent=e,a.parentElement.insertBefore(o,a.nextElementSibling),setTimeout(()=>{o.remove()},5e3)}function o(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).url}function r(){const a=document.querySelector("#listado-tareas");!function(e){for(;e.firstChild;)e.removeChild(e.firstChild)}(a),0!==t.length?t.forEach(t=>{a.appendChild(function(t){const a=document.createElement("LI");return a.dataset.tareaId=t.id,a.classList.add("tarea"),a.appendChild(function(e){const t=document.createElement("P");return t.textContent=e,t}(t.nombre)),a.appendChild(function(t){const a=document.createElement("DIV");return a.classList.add("opciones"),a.appendChild(function(t){const a=document.createElement("BUTTON");return a.classList.add("estado-tarea"),a.classList.add(""+e[t.estado].toLowerCase()),a.textContent=e[t.estado],a.dataset.estadoTarea=t.estado,a.ondblclick=function(){!function(e){nuevoEstado="0"===e.estado?"1":"0",e.estado=nuevoEstado,async function(e){const{estado:t,id:a,nombre:r}=e,c=new FormData;c.append("id",a),c.append("nombre",r),c.append("estado",t),c.append("proyectoUrl",o());try{const e="/api/tarea/actualizar",t=await fetch(e,{method:"POST",body:c}),a=await t.json();"exito"===a.tipo&&n(a.mensaje,a.tipo,document.querySelector(".contenedor-nueva-tarea"))}catch(e){}}(e)}({...t})},a}(t)),a.appendChild(function(e){const t=document.createElement("BUTTON");return t.classList.add("eliminar-tarea"),t.dataset.idTarea=e,t.textContent="Eliminar",t}(t.id)),a}(t)),a}(t))}):a.appendChild(function(){const e=document.createElement("LI");return e.textContent="No hay tareas por realizar",e.classList.add("no-tareas"),e}())}!async function(){try{const e="/api/tareas?url="+o(),a=await fetch(e),n=await a.json();t=n.tareas,r()}catch(e){console.log(e)}}(),document.querySelector("#agregar-tarea").addEventListener("click",a)}();