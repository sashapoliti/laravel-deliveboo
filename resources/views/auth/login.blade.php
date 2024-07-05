@extends('layouts.admin')

@section('content')
    <div class="container my-4">
        <form method="POST" action="{{ route('login') }}" class="form">
            @csrf

            <p class="title">Login </p>
            <p class="message">Inserisci per accedere</p>
            <label for="email">
                <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <span>Indirizzo Email</span>
            </label>

            <label for="password">
                <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password"
                    required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <span>Password</span>
            </label>

            <div class="form-check d-flex justify-content-center">
                <input class="form-check-input custom-checkbox" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label mx-2" for="remember">
                    Ricordami
                </label>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="container-btn-file">
                    Accedi
                </button>
            </div>

            @if (Route::has('password.request'))
                <a class="btn  btn-link link" href="{{ route('password.request') }}">
                    Dimenticato la tua Password?
                </a>
            @endif

            <p class="signin">Non hai un account? <a href="{{ route('register') }}">Registrati</a> </p>
        </form>
    </div>
@endsection


<style lang="scss" scoped>
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



    .link {
        color: #307750 !important;
    }

    .form {
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 15px;
        max-width: 550px;
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
        text-decoration: underline #307750;
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

    .form label .input:valid+span {
        color: green;
    }

    .submit {
        border: none;
        outline: none;
        background-color: #68BA01;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
        font-size: 16px;
        transform: .3s ease;
    }

    .submit:hover {
        background-color: #5ca700;
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
