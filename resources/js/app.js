import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import Chart from 'chart.js/auto'
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

  
const imageInput = document.getElementById("upload_image");
if (imageInput) {
    imageInput.addEventListener("change", function () {
        const preview = document.getElementById("uploadPreview");
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(imageInput.files[0]);
    });
}

const logoInput = document.getElementById("upload_logo");
if (logoInput) {
    logoInput.addEventListener("change", function () {
        const preview = document.getElementById("uploadPreviewLogo");
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(logoInput.files[0]);
    });
}



// colletction di array di bottoni delete
const deleteSubmitButtons = document.querySelectorAll(".delete-button");
// tramite il forEach prendiamo tutti i bottoni delete e aggiungiamo l'event listener
deleteSubmitButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
        event.preventDefault();
        // prendiamo il valore dell'attributo data-item-title
        const dataTitle = button.getAttribute("data-item-title");
        // prendiamo la modal
        const modal = document.getElementById("deleteModal");

        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();
        // impostiamo il titolo della modale con il valore del data-item-title
        const modalItemTitle = modal.querySelector("#modal-item-title");
        modalItemTitle.textContent = dataTitle;
        //prendiamo il bottone delete della modal
        const buttonDelete = modal.querySelector("button.btn-primary");
        // aggiungiamo l'event listener al bottone delete della modale
        buttonDelete.addEventListener("click", () => {
            button.parentElement.submit();
        });
    });
});



document.addEventListener('DOMContentLoaded', function () {
    if (typeof monthlyProfits !== 'undefined' && document.getElementById('guadagni')) {
        const data = monthlyProfits.map(profit => ({
            yearMonth: `${profit.year}-${String(profit.month).padStart(2, '0')}`,
            total_profit: profit.total_profit,
        }));

        const labels = data.map(row => row.yearMonth);
        const profits = data.map(row => row.total_profit);

        new Chart(
            document.getElementById('guadagni'),
            {
                type: 'bar',
                options: {
                    animation: true,
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                },
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Guadagni',
                            data: profits,
                            borderColor: '#69BB01',
                        }
                    ]
                }
            }
        );
    }
});











// document.addEventListener('DOMContentLoaded', function() {
//   const checkboxes = document.querySelectorAll('input[name="types[]"]');
//   const typeHelp = document.getElementById('typeHelp');

//   function validateCheckbox() {
//       let isChecked = false;
//       checkboxes.forEach(function(checkbox) {
//           if (checkbox.checked) {
//               isChecked = true;
//           }
//       });

//       if (!isChecked) {
//           typeHelp.textContent = 'Seleziona almeno un tipo';
//       } else {
//           typeHelp.textContent = '';
//       }
//   }

//   checkboxes.forEach(function(checkbox) {
//       checkbox.addEventListener('change', validateCheckbox);
//   });

//   // Validazione iniziale
//   validateCheckbox();
// });
