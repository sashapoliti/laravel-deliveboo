@extends('layouts.app')

@section('content')
<div class="container my-4 d-flex justify-content-center">
    <div class="justify-content-center">
        <div>
            <div class="card px-5">

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="form">
                        @csrf
                        <p class="title">Forgot Password </p> 
                        <p class="message">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

                          <label for="email">
                            <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            <span>Email Address</span>
                          </label> 

                          <button type="submit" class="submit">
                              {{ __('Send Password Reset Link') }}
                          </button>
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







