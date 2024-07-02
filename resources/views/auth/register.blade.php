@extends('layouts.app')

@section('content')
<div class="container my-4 d-flex justify-content-center">
    <div class="justify-content-center">
        <div>
            <div class="card px-5">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" class="form" enctype="multipart/form-data">
                        @csrf
                        <p class="title">Register </p>
                        <p class="message">Signup now and get full access to our app. </p>

                        <!-- User fields -->
                        <label for="name">
                            <input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            <span>Name</span>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </label>

                        <label for="email">
                            <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            <span>Email</span>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </label>

                        <label for="password">
                            <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <span>Password</span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </label>

                        <label for="password-confirm">
                            <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                            <span>Confirm password</span>
                        </label>

                        <!-- Restaurant fields -->
                        <label for="restaurant_name">
                            <input id="restaurant_name" type="text" class="input @error('restaurant_name') is-invalid @enderror" name="restaurant_name" value="{{ old('restaurant_name') }}" required autocomplete="restaurant_name">
                            <span>Restaurant Name</span>
                            @error('restaurant_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </label>

                        <label for="address">
                            <input id="address" type="text" class="input @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">
                            <span>Address</span>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </label>

                        <label for="vat_number">
                            <input id="vat_number" type="text" class="input @error('vat_number') is-invalid @enderror" name="vat_number" value="{{ old('vat_number') }}" required autocomplete="vat_number">
                            <span>VAT Number</span>
                            @error('vat_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </label>

                        <label for="image">
                            <input id="image" type="file" class="input @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">
                            <span>Restaurant Image</span>
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </label>

                        <label for="logo">
                            <input id="logo" type="file" class="input @error('logo') is-invalid @enderror" name="logo" value="{{ old('logo') }}">
                            <span>Restaurant Logo</span>
                            @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </label>

                        <!-- Checkbox for restaurant types -->
                        <div class="form-group">
                            <p>Select Type:</p>
                            @foreach ($types as $type)
                                <div>
                                    <input class="form-check-input @error('types') is-invalid @enderror" type="checkbox" value="{{ $type->id }}" name="types[]">
                                    <label class="form-check-label" for="types[]">
                                        {{ $type->name }}
                                    </label>
                                </div>
                            @endforeach
                            @error('types')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="submit">
                            {{ __('Register') }}
                        </button>
                        <p class="signin">Already have an account? <a href="{{ route('login') }}">Signin</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




<style lang="scss" scoped>

  .form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-width: 400px;
    background-color: #fff;
    padding: 20px;
    border-radius: 20px;
    position: relative;
  }
  
  .title {
    font-size: 28px;
    color:  #67BA02;
    font-weight: 600;
    letter-spacing: -1px;
    position: relative;
    display: flex;
    align-items: center;
    padding-left: 30px;
  }
  
  .title::before,.title::after {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    border-radius: 50%;
    left: 0px;
    background-color:  #70ca02;
  }
  
  .title::before {
    width: 18px;
    height: 18px;
    background-color:  #7bdb05;
  }
  
  .title::after {
    width: 18px;
    height: 18px;
    animation: pulse 1s linear infinite;
  }
  
  .message, .signin {
    color: rgba(88, 87, 87, 0.822);
    font-size: 14px;
  }
  
  .signin {
    text-align: center;
  }
  
  .signin a {
    color: #68BA01;
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
  
  .form label .input + span {
    position: absolute;
    left: 10px;
    top: 15px;
    color: grey;
    font-size: 0.9em;
    cursor: text;
    transition: 0.3s ease;
  }
  
  .form label .input:placeholder-shown + span {
    top: 15px;
    font-size: 0.9em;
  }
  
  .form label .input:focus + span,.form label .input:valid + span {
    top: 30px;
    font-size: 0.7em;
    font-weight: 600;
  }
  
  .form label .input:valid + span {
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







