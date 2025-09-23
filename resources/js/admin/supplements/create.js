document.addEventListener("DOMContentLoaded", function () {
    // Preview image functionality
    const imageInput = document.getElementById("image");

    if (imageInput) {
        imageInput.addEventListener("change", function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Si ya existe una vista previa, la eliminamos
                    let existingPreview =
                        document.querySelector(".image-preview");
                    if (existingPreview) {
                        existingPreview.remove();
                    }

                    // Crear elemento para la vista previa
                    const preview = document.createElement("div");
                    preview.className = "image-preview mt-4";
                    preview.innerHTML = `
                        <div class="flex items-center gap-4">
                            <img src="${e.target.result}" class="h-24 w-auto object-contain border rounded" alt="Vista previa">
                            <div class="text-sm">
                                <p class="font-medium">Vista previa de la imagen</p>
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
});
