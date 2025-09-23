document.addEventListener("DOMContentLoaded", function () {
    // Preview image functionality
    const imageInput = document.getElementById("image");

    if (imageInput) {
        imageInput.addEventListener("change", function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Si ya existe una vista previa de la nueva imagen, la eliminamos
                    let existingPreview =
                        document.querySelector(".new-image-preview");
                    if (existingPreview) {
                        existingPreview.remove();
                    }

                    // Crear elemento para la vista previa
                    const preview = document.createElement("div");
                    preview.className = "new-image-preview mt-4";
                    preview.innerHTML = `
                        <div class="flex items-center gap-4">
                            <img src="${e.target.result}" class="h-24 w-auto object-contain border rounded" alt="Vista previa">
                            <div class="text-sm">
                                <p class="font-medium">{{ trans('admin/admin.preview_new_image') }}</p>
                                <p class="text-base-content/70">${imageInput.files[0].name}</p>
                            </div>
                        </div>
                    `;

                    // Insertar después del input
                    imageInput.parentNode.appendChild(preview);
                };

                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Checkbox para eliminar imagen
    const removeImageCheckbox = document.querySelector(
        'input[name="remove_image"]'
    );

    if (removeImageCheckbox) {
        removeImageCheckbox.addEventListener("change", function () {
            const imageInput = document.getElementById("image");

            if (this.checked) {
                // Si está marcado para eliminar, deshabilitar la subida
                imageInput.disabled = true;
                imageInput.classList.add("opacity-50");
            } else {
                // Si no, habilitar la subida
                imageInput.disabled = false;
                imageInput.classList.remove("opacity-50");
            }
        });
    }
});
