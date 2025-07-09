import "./bootstrap";

// FilePond
import * as FilePond from "filepond";
import "filepond/dist/filepond.min.css";

import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css";

// Register plugin
FilePond.registerPlugin(FilePondPluginImagePreview);

// Inisialisasi setelah DOM ready (jika kamu mount di Blade)
document.addEventListener("DOMContentLoaded", function () {
    const input = document.querySelector("#logo");
    if (input) {
        FilePond.create(input, {
            allowImagePreview: true,
            imagePreviewMaxHeight: 150,
            labelIdle:
                'Drag & drop logo atau <span class="filepond--label-action">Telusuri</span>',
        });
    }
});
