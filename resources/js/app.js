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
        const buttonDelete = modal.querySelector("button.btn-danger");
        // aggiungiamo l'event listener al bottone delete della modale
        buttonDelete.addEventListener("click", () => {
            button.parentElement.submit();
        });
    });
});

if (typeof monthlyData !== 'undefined' && typeof startMonth !== 'undefined' && document.getElementById('guadagni')) {
    const generateMonths = (start, count) => {
        const startDate = new Date(start);
        return Array.from({ length: count }, (v, i) => {
            const date = new Date(startDate.getFullYear(), startDate.getMonth() - i, 1);
            return {
                yearMonth: `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}`,
                total_profit: 0,
                order_count: 0
            };
        }).reverse();
    };

    const months = generateMonths(new Date(), 12);

    monthlyData.forEach(data => {
        const index = months.findIndex(month => month.yearMonth === `${data.year}-${String(data.month).padStart(2, '0')}`);
        if (index !== -1) {
            months[index].total_profit = data.total_profit;
            months[index].order_count = data.order_count;
        }
    });

    const labels = months.map(row => row.yearMonth);
    const profits = months.map(row => row.total_profit);
    const orderCounts = months.map(row => row.order_count);

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
                        enabled: true,
                        callbacks: {
                            label: function(context) {
                                const index = context.dataIndex;
                                const profit = profits[index];
                                const count = orderCounts[index];
                                return `Guadagni: ${profit} € | Ordini: ${count}`;
                            }
                        }
                    }
                }
            },
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Guadagni',
                        data: profits,
                        backgroundColor: 'rgba(245, 185, 125, 0.7)', // Colore con opacità
                        borderColor: 'rgb(196, 148, 100)', // Colore
                        borderWidth: 2
                    }
                ]
            }
        }
    );
}




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
