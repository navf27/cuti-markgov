@extends('layout.app')
@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-warning">
                <div class="card-header">
                    <h2>Update Password</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.password.update') }}">
                        @method('patch')
                        @csrf
                        <div class="form-group row">
                            <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Current
                                Password') }}</label>

                            <div class="col-md-6">
                                <div class="input-group" id="showHideCurrent">
                                    <input id="current_password" type="password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    name="current_password" required autocomplete="current_password" placeholder="Masukkan password anda saat ini">
                                    <span class="input-group-text">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </span>
                                </div>

                                @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password')}}</label>

                            <div class="col-md-6">
                                <div class="input-group" id="showHidePassword">
                                    <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password" placeholder="Masukkan password baru anda">
                                    <span class="input-group-text">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </span>
                                </div>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <div class="input-group" id="showHideConfirm">
                                    <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi password baru">
                                    <span class="input-group-text">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        showHide('showHideCurrent');
        showHide('showHidePassword');
        showHide('showHideConfirm')
    });

    const showHide = (id) => {
        $("#"+id+ " a").on('click', function(event) {
            event.preventDefault();
            if($("#"+id).find('input').attr("type") == "text"){
                $("#"+id).find('input').attr('type', 'password');
                $("#"+id).find('i').addClass( "fa-eye-slash" );
                $("#"+id).find('i').removeClass( "fa-eye" );
            }else if($("#"+id).find('input').attr("type") == "password"){
                $("#"+id).find('input').attr('type', 'text');
                $("#"+id).find('i').removeClass( "fa-eye-slash" );
                $("#"+id).find('i').addClass( "fa-eye" );
            }
        });
    }
</script>
@endpush