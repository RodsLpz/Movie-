@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-8">
            <div class="card" style="background: #008891 !important; color:white;">
                <div class="card-header" >{{ __('Login') }}</div>

                <div class="card-body" >
                    <!-- <form method="POST" action="{{ route('login') }}"> -->
                        <!-- @csrf -->

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" class="btn btn-primary" id="login">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
 $(document).ready(function() {
    $('#login').on('click', function() {
        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            url: "{{ route('login') }}",
            headers: {
                      'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                username: username,
                password: password
            },
            method:"post",
            dataType:"json",
            success:function(e){
                if(e.msg=="OK"){
                    window.location = 'movies';
                }
                else{
                    alert("ERROR: "+ e.msg);
                }
            }
        });
    });
 });
</script>
@endsection
