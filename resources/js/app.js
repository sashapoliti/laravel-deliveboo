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



(async function() {
  const data = [
    { year: 2010, count: 10 },
    { year: 2011, count: 40 },
    { year: 2012, count: 15 },
    { year: 2013, count: 25 },
    { year: 2014, count: 22 },
    { year: 2015, count: 30 },
    { year: 2016, count: 28 },
  ];
  
  new Chart(
    document.getElementById('guadagni'),
    {
      type: 'line',
      options: {
        animation: true,
        responsive: true,
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            enabled: false
          }
        }
      },
      data: {
        labels: data.map(row => row.year),
        datasets: [
          {
            label: 'guadagni',
            data: data.map(row => row.count),
            borderColor: '#69BB01',
          }
        ]
      }
    }
  );
  
})();

document.addEventListener('DOMContentLoaded', function() {
  const checkboxes = document.querySelectorAll('input[name="types[]"]');
  const typeHelp = document.getElementById('typeHelp');

  function validateCheckbox() {
      let isChecked = false;
      checkboxes.forEach(function(checkbox) {
          if (checkbox.checked) {
              isChecked = true;
          }
      });

      if (!isChecked) {
          typeHelp.textContent = 'Seleziona almeno un tipo';
      } else {
          typeHelp.textContent = '';
      }
  }

  checkboxes.forEach(function(checkbox) {
      checkbox.addEventListener('change', validateCheckbox);
  });

  // Validazione iniziale
  validateCheckbox();
});
