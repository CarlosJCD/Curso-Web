(function () {
    const tagsInput = document.querySelector('#tags_input');
    if (tagsInput) {
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

                console.log(tags);
            }
        }
    }

})();