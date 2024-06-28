import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])


const side = document.getElementById('sidebar');
const but = document.getElementById('closeSidebar');
const icon = but.querySelector('.fa-solid'); // Get the icon element within the button

but.addEventListener('click', () => {
  side.classList.toggle('d-none');

  icon.classList.toggle('fa-chevron-left'); // Toggle between left and right icons
  icon.classList.toggle('fa-chevron-right'); // Toggle between left and right icons
});


const image = document.getElementById("upload_image");
if(image) {
    image.addEventListener("change", function () {

        const preview = document.getElementById("uploadPreview");
        const reader = new FileReader();
        reader.readAsDataURL(image.files[0]);
        reader.onload = function (reader){
            preview.src = reader.target.result;
        };
    });
}