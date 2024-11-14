import Cropper from "cropperjs";
import "cropperjs/dist/cropper.min.css";

document.addEventListener("DOMContentLoaded", () => {
    let cropper;

    const fileInput = document.getElementById("fileInput");
    const imagePreview = document.getElementById("imagePreview");
    const saveButton = document.getElementById("saveButton");
    const croppedImage = document.getElementById("croppedImage");

    fileInput.addEventListener("change", (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = (e) => {
            imagePreview.src = e.target.result;

            if (cropper) cropper.destroy();

            cropper = new Cropper(imagePreview, {
                aspectRatio: 1,
                viewMode: 1,
                minCropBoxWidth: 200,
                minCropBoxHeight: 200,
                background: false,
            });
        };

        reader.readAsDataURL(file);
    });

    saveButton.addEventListener("click", () => {
        if (cropper) {
            cropper
                .getCroppedCanvas({ width: 400, height: 400 })
                .toBlob((blob) => {
                    const formData = new FormData();
                    formData.append("profile_image", blob);
                    // Actualiza la imagen en el contenedor de perfil
                    /* const url = URL.createObjectURL(blob);
                    croppedImage.src = url; */
                    // Opcional: Enviar la imagen al backend

                    fetch("/update-photo", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                        },
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            // console.log(data.message);
                            // alert(data.image_url);
                            if (
                                data.message === "Imagen subida correctamente"
                            ) {
                                setTimeout(() => {
                                    window.location.reload(); // Recarga la página
                                }, 1000);
                            }
                        })
                        .catch((error) => console.error(error));
                });
        }
    });
});
