{{-- Premium Upload Preview Script --}}
{{-- Overrides the default previewFile() from plugins.js to work with the
.premium-upload-box layout where the <img> is inside a child <div>
    rather than being a direct previous sibling of the <input>. --}}
    <script>
        function previewFile(input) {
            "use strict";
            var uploadBox = input.closest('.premium-upload-box');
            if (!uploadBox) {
                // Fallback: try the original plugins.js behavior (previousElementSibling)
                var prev = input.previousElementSibling;
                if (prev && prev.tagName === 'IMG') {
                    var reader = new FileReader();
                    var file = input.files[0];
                    if (file && file.size > 5 * 1024 * 1024) {
                        alert('Maximum file size is 5MB!');
                        return;
                    }
                    reader.onloadend = function () { prev.src = reader.result; prev.style.display = 'block'; };
                    if (file) reader.readAsDataURL(file);
                }
                return;
            }

            var previewImg = uploadBox.querySelector('.upload-preview');
            var file = input.files[0];

            if (!file) return;

            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert('Maximum file size is 5MB!');
                input.value = '';
                return;
            }

            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file.');
                input.value = '';
                return;
            }

            var reader = new FileReader();
            reader.onloadend = function () {
                if (previewImg) {
                    previewImg.src = reader.result;
                    previewImg.style.display = 'block';
                }
                // Update the upload text to show filename
                var uploadText = uploadBox.querySelector('.upload-text');
                if (uploadText) {
                    uploadText.innerHTML = '<i class="fa-solid fa-check-circle" style="color: #4ade80; margin-right: 6px;"></i>' + file.name;
                }
            };
            reader.readAsDataURL(file);
        }
    </script>