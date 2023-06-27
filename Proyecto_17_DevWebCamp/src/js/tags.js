(function () {
    const tagsInput = document.querySelector('#tags_input');
    if (tagsInput) {

        const tagsDiv = document.querySelector('#tags');
        const tagsInputHidden = document.querySelector('[name="tags"]');

        let tags = [];
        tagsInput.addEventListener('keypress', guardarTag);

        function guardarTag(e) {
            if (e.keyCode === 44) {
                const tagNuevo = e.target.value.trim();
                if (tagNuevo === '' || tagNuevo.length < 2) {
                    return;
                }

                e.preventDefault();

                tags = [...tags, tagNuevo]

                tagsInput.value = '';

                mostrarTags();
            }
        }

        function mostrarTags() {
            tagsDiv.textContent = '';
            tags.forEach(tag => {
                const liTag = document.createElement('LI');
                liTag.classList.add('formulario__tag');
                liTag.textContent = tag;
                liTag.ondblclick = eliminarTag;
                tagsDiv.appendChild(liTag);
            });
            actualizarInputHidden();
        }

        function eliminarTag(e) {
            e.target.remove();

            tags = tags.filter(tag => tag !== e.target.textContent)
            actualizarInputHidden();
        }

        function actualizarInputHidden() {
            tagsInputHidden.value = tags.toString();
        }
    }

})();