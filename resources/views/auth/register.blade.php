@extends('layouts.app')

@section('title')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/register.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="register-page" class="row">
                    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8">
                        <form class="login-form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5 class="ml-4">Register</h5>
                                    <p class="ml-4">Join to our community now !</p>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input id="name" type="text" class="@error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <label for="name" class="center-align">Nama</label>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input id="username" type="text" class="@error('username') is-invalid @enderror"
                                        name="username" value="{{ old('username') }}" required autocomplete="username">
                                    <label for="username" class="center-align">Username</label>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="password" type="password" class="@error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password">
                                    <label for="password">Password</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="password-confirm" type="password" name="password_confirmation" required
                                        autocomplete="new-password">
                                    <label for="password-confirm">Confirm Password</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button type="submit"
                                        class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Register</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <p class="margin medium-small"><a href="{{ route('login') }}">Already have an account?
                                            Login</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil disimpan',
            })
        </script>
    @elseif (session()->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Data gagal disimpan',
        })
    </script>
    @endif
@endpush
