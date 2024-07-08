@extends('layouts.admin')

@section('title', 'Registrazione')

@section('content')
    <div class="container my-5">
        <form method="POST" action="{{ route('register') }}" class="form pb-5" enctype="multipart/form-data"
            id="registrationForm">
            @csrf
            <p class="title">Registrazione</p>
            <p class="message">Iscriviti ora e ottieni l'accesso completo alla nostra app.</p>

            <div class="row gy-4">
                <!-- User fields -->
                <div class="col-6">
                    <label for="name" class="w-100">
                        <input id="name" type="text" class="input @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" autocomplete="name" autofocus minlength="3"
                            maxlength="255">
                        <span class="mx-3">Nome <span class="text-danger">*</span></span>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <strong id="error_name" class="text-danger" style="font-size: 12px"></strong>
                    </label>
                </div>

                <div class="col-6">
                    <label for="email" class="w-100">
                        <input id="email" type="email" class="input @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}"
                            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" autocomplete="email">
                        <span class="mx-3">Indirizzo Email <span class="text-danger">*</span></span>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <strong id="error_email" class="text-danger" style="font-size: 12px"></strong>
                    </label>
                </div>

                <div class="col-6">
                    <label for="password" class="w-100">
                        <input id="password" type="password" class="input @error('password') is-invalid @enderror"
                            name="password" autocomplete="new-password" minlength="8" maxlength="50"
                            oninput="validatePassword()">
                        <span class="mx-3">Password <span class="text-danger">*</span></span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                    <strong id="error_password" class="text-danger" style="font-size: 12px"></strong>
                </div>

                <div class="col-6">
                    <label for="password-confirm" class="w-100">
                        <input id="password-confirm" type="password" class="input" name="password_confirmation"
                            autocomplete="new-password" minlength="8" maxlength="50" oninput="validatePassword()">
                        <span class="mx-3">Conferma password <span class="text-danger">*</span></span>
                    </label>
                    <strong id="error_password_confirm" class="text-danger" style="font-size: 12px"></strong>
                </div>

                <!-- Restaurant fields -->
                <div class="col-6">
                    <label for="restaurant_name" class="w-100">
                        <input id="restaurant_name" type="text"
                            class="input @error('restaurant_name') is-invalid @enderror" name="restaurant_name"
                            value="{{ old('restaurant_name') }}" autocomplete="restaurant_name" minlength="3"
                            maxlength="255">
                        <span class="mx-3">Nome Ristorante <span class="text-danger">*</span></span>
                        @error('restaurant_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                    <strong id="error_restaurant_name" class="text-danger" style="font-size: 12px"></strong>
                </div>

                <div class="col-6">
                    <label for="vat_number" class="w-100">
                        <input id="vat_number" type="number" class="input @error('vat_number') is-invalid @enderror"
                            name="vat_number" value="{{ old('vat_number') }}" minlength="11" maxlength="11"
                            autocomplete="vat_number">
                        <span class="mx-3">Partita IVA <span class="text-danger">*</span></span>
                        @error('vat_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                    <strong id="error_vat_number" class="text-danger" style="font-size: 12px"></strong>
                </div>

                <label for="address">
                    <input id="address" type="text" class="input @error('address') is-invalid @enderror"
                        name="address" value="{{ old('address') }}" minlength="3" maxlength="255"
                        autocomplete="address">
                    <span class="mx-4">Indirizzo <span class="text-danger">*</span></span>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <strong id="error_address" class="text-danger" style="font-size: 12px"></strong>
                </label>

                <label for="description">
                    <p class="message mx-3">Descrizione Ristorante</p>
                    <textarea id="description" class="input @error('description') is-invalid @enderror" name="description"
                        minlength="3" maxlength="255" autocomplete="description">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <strong id="error_description" class="text-danger" style="font-size: 12px"></strong>
                </label>

                <div class="col-6">
                    <div class="container-img">
                        <img src="https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg"
                            alt="" id="uploadPreview" class="shadow rounded-4 m-4">
                    </div>
                    <label class="d-flex justify-content-center" for="image">
                        <label for="upload_image" class="container-btn-file" id="upload_file">
                            <i class="fa-regular fa-file"></i>
                            Carica immagine
                            <input id="upload_image" type="file" accept="image/*"
                                class="input py-2 @error('image') is-invalid @enderror" name="image" maxlength="2048"
                                style="display: none;">
                        </label>
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                </div>

                <div class="col-6">
                    <div class="container-img">
                        <img src="https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg"
                            alt="" id="uploadPreviewLogo" class="shadow rounded-4 m-4">
                    </div>
                    <label class="d-flex justify-content-center" for="upload_logo">
                        <label for="upload_logo" class="container-btn-file" id="upload_file">
                            <i class="fa-regular fa-file"></i>
                            Carica logo
                            <input id="upload_logo" type="file" accept="image/*"
                                class="input py-2 @error('logo') is-invalid @enderror" name="logo" maxlength="2048"
                                style="display: none;">
                        </label>
                        @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                </div>

                <!-- Checkbox for restaurant types -->
                <div class="col-12 mb-3" id="checkboxContainer">
                    <div class="container">
                        <div class="row">
                            <h5 class="mb-3 ms-2">Seleziona le tipologie del ristorante <span class="text-danger">*</span> :</h5>
                            @foreach ($types as $type)
                                <div class="col-3">
                                    <input class="form-check-input custom-checkbox @error('types') is-invalid @enderror"
                                        type="checkbox" value="{{ $type->id }}" name="types[]"
                                        id="type_{{ $type->id }}">
                                    <label class="form-check-label"
                                        for="type_{{ $type->id }}">{{ $type->name }}</label>
                                </div>
                            @endforeach
                            @error('types')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <strong id="error_types" class="text-danger" style="font-size: 12px"></strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <em>I campi con <span class="text-danger">*</span> sono obbligatori</em>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="container-btn-file" id="button">
                    Registrati
                </button>
            </div>
            <p class="signin">Hai già un account? <a href="{{ route('login') }}">Accedi</a></p>
        </form>
    </div>

    <script>
        let name = document.getElementById("name");
        let error_name = document.getElementById("error_name");

        let email = document.getElementById("email");
        let error_email = document.getElementById("error_email");

        let password = document.getElementById("password");
        let error_password = document.getElementById("error_password");

        let confirm_password = document.getElementById("password-confirm");
        let error_password_confirm = document.getElementById("error_password_confirm");

        let restaurant_name = document.getElementById("restaurant_name");
        let error_restaurant_name = document.getElementById("error_restaurant_name");

        let vat_number = document.getElementById("vat_number");
        let error_vat_number = document.getElementById("error_vat_number");

        let address = document.getElementById("address");
        let error_address = document.getElementById("error_address");

        let description = document.getElementById("description");
        let error_description = document.getElementById("error_description");

        let checkboxes = document.querySelectorAll('#checkboxContainer input[type="checkbox"]');
        let error_types = document.getElementById("error_types");

        function validateForm(event) {
            let valid = true;

            if (!name.value) {
                error_name.innerHTML = "Il nome è obbligatorio.";
                name.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else if (name.value.length < 3) {
                error_name.innerHTML = "Il nome deve avere almeno 3 caratteri.";
                name.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else if (name.value.length > 255) {
                error_name.innerHTML = "Il nome deve avere al massimo 255 caratteri.";
                name.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else if (!/^[a-zA-Z-']+$/.test(name.value)) {
                error_name.innerHTML = 'Il nome deve contenere solo lettere nessuno spazio.';
                name.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else {
                error_name.innerHTML = "";
            }

            // Email field
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.value === "") {
                error_email.innerHTML = "L'email è obbligatoria.";
                email.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else if (!emailPattern.test(email.value)) {
                error_email.innerHTML = "L'email non è valida.";
                email.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else {
                error_email.innerHTML = "";
            }

            // Password field
            if (password.value === "") {
                error_password.innerHTML = "La password è obbligatoria.";
                password.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else if (password.value.length < 8) {
                error_password.innerHTML = "La password deve avere almeno 8 caratteri.";
                password.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else if (password.value.length > 50) {
                error_password.innerHTML = "La password deve avere al massimo 50 caratteri.";
                password.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else {
                error_password.innerHTML = "";
            }

            // Confirm Password field
            if (confirm_password.value === "") {
                error_password_confirm.innerHTML = "La conferma della password è obbligatoria.";
                confirm_password.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else if (password.value !== confirm_password.value) {
                error_password_confirm.innerHTML = "Le password non corrispondono.";
                confirm_password.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else {
                error_password_confirm.innerHTML = "";
            }

            // Restaurant name field
            if (restaurant_name.value === "") {
                error_restaurant_name.innerHTML = "Il nome del ristorante è obbligatorio.";
                restaurant_name.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else if (restaurant_name.value.length < 3) {
                error_restaurant_name.innerHTML = "Il nome del ristorante deve avere almeno 3 caratteri.";
                restaurant_name.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else if (restaurant_name.value.length > 255) {
                error_restaurant_name.innerHTML = "Il nome del ristorante deve avere al massimo 255 caratteri.";
                restaurant_name.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else {
                error_restaurant_name.innerHTML = "";
            }

            // VAT number field
            if (vat_number.value === "") {
                error_vat_number.innerHTML = "La partita IVA è obbligatoria.";
                vat_number.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else if (!/^\d{11}$/.test(vat_number.value)) {
                error_vat_number.innerHTML = "La partita IVA deve essere esattamente di 11 cifre.";
                vat_number.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else {
                error_vat_number.innerHTML = "";
            }

            // Address field
            if (address.value === "") {
                error_address.innerHTML = "L'indirizzo è obbligatorio.";
                address.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else if (address.value.length < 3 || address.value.length > 255) {
                error_address.innerHTML = "L'indirizzo deve essere tra 3 e 255 caratteri.";
                address.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else {
                error_address.innerHTML = "";
            }

            // Description field (optional)
            if (description.value !== "" && description.value.length < 3) {
                error_description.innerHTML = "La descrizione deve avere almeno 3 caratteri.";
                description.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else if (description.value !== "" && description.value.length > 255) {
                error_description.innerHTML = "La descrizione deve avere al massimo 255 caratteri.";
                description.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else {
                error_description.innerHTML = "";
            }

            // Checkbox validation
            let checkedCount = 0;
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    checkedCount++;
                }
            });

            if (checkedCount < 1) {
                error_types.innerHTML = "Seleziona almeno una tipologia.";
                checkboxes[0].scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                valid = false;
            } else {
                error_types.innerHTML = "";
            }

            // Prevent form submission if there are validation errors
            if (!valid) {
                event.preventDefault();
            }
        }

        // Add event listener for form submit
        document.getElementById('registrationForm').addEventListener('submit', validateForm);

        // Image preview functionality
        const imageInput = document.getElementById("upload_image");
        if (imageInput) {
            imageInput.addEventListener("change", function() {
                const preview = document.getElementById("uploadPreview");
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(imageInput.files[0]);
            });
        }

        const logoInput = document.getElementById("upload_logo");
        if (logoInput) {
            logoInput.addEventListener("change", function() {
                const preview = document.getElementById("uploadPreviewLogo");
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(logoInput.files[0]);
            });
        }
    </script>

@endsection








<style lang="scss" scoped>
    .container-img {
        width: 350px !important;
        height: 350px;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container-btn-file {
        display: flex;
        position: relative;
        justify-content: center;
        align-items: center;
        background-color: #307750;
        color: #fff;
        border-style: none;
        padding: 10px 30px;
        border-radius: 0.5em;
        overflow: hidden;
        z-index: 1;
        transition: all 250ms;
        cursor: pointer;
        width: 240px;
        height: 50px;
    }

    .container-btn-file input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .container-btn-file>i {
        font-size: 1.5rem;
        margin-right: 1em;
    }

    .container-btn-file::before {
        content: "";
        position: absolute;
        height: 100%;
        width: 0;
        border-radius: 0.5em;
        background-color: #469b61;
        z-index: -1;
        transition: all 350ms;
    }

    .container-btn-file:hover::before {
        width: 100%;
    }



    .custom-checkbox:checked {
        background-color: #307750 !important;
        border-color: #307750 !important;
    }

    .form {
        margin: 0 auto;
        max-width: 1000px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 20px;
        border-radius: 20px;
        position: relative;
    }

    .title {
        font-size: 28px;
        color: #307750;
        font-weight: 600;
        letter-spacing: -1px;
        position: relative;
        display: flex;
        align-items: center;
        padding-left: 30px;
    }

    .title::before,
    .title::after {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        border-radius: 50%;
        left: 0px;
        background-color: #3a644c;
    }

    .title::before {
        width: 18px;
        height: 18px;
        background-color: #427257;
    }

    .title::after {
        width: 18px;
        height: 18px;
        animation: pulse 1s linear infinite;
    }

    .message,
    .signin {
        color: rgba(88, 87, 87, 0.822);
        font-size: 14px;
    }

    .signin {
        text-align: center;
    }

    .signin a {
        color: #307750;
    }

    .signin a:hover {
        text-decoration: underline #5ca700;
    }

    .flex {
        display: flex;
        width: 100%;
        gap: 6px;
    }

    .form label {
        position: relative;
    }

    .form label .input {
        width: 100%;
        padding: 10px 10px 20px 10px;
        outline: 0;
        border: 1px solid rgba(105, 105, 105, 0.397);
        border-radius: 10px;
    }

    .form label .input+span {
        position: absolute;
        left: 10px;
        top: 15px;
        color: grey;
        font-size: 0.9em;
        cursor: text;
        transition: 0.3s ease;
    }

    .form label .input:placeholder-shown+span {
        top: 15px;
        font-size: 0.9em;
    }

    .form label .input:focus+span,
    .form label .input:valid+span {
        top: 30px;
        font-size: 0.7em;
        font-weight: 600;
    }

    /* .form label .input:valid+span {
        color: green;
    } */

    .submit {
        border: none;
        outline: none;
        background-color: #307750;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
        font-size: 16px;
        transform: .3s ease;
        transition: background-color 0.3s ease-in-out;
    }

    .submit:hover {
        background-color: #469b61;
    }

    @keyframes pulse {
        from {
            transform: scale(0.9);
            opacity: 1;
        }

        to {
            transform: scale(1.8);
            opacity: 0;
        }
    }
</style>
