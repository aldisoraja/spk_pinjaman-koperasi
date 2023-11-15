@extends('layouts.app')

@section('title')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/login.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="login-page" class="row">
                    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                        <div class="row">
                            <div class="input-field col s12 mb-0">
                                <center><img src="{{asset('assets/images/logo/2.png')}}" alt="logo" style="width: 150px; height: 150px; margin-top: 0px"></center>
                            </div>
                            <div class="input-field col s12 mt-0">
                                <center><h5>Koperasi Aneka Usaha Sido Makmur</h5></center>
                            </div>
                        </div>
                        <form class="login-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5 class="ml-4">Sign in</h5>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input id="username" name="username" type="text"
                                        class="@error('username') is-invalid @enderror" value="{{ old('username') }}"
                                        required autocomplete="username" autofocus />
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
                                    <input id="password" name="password" type="password"
                                        class="@error('password') is-invalid @enderror" required
                                        autocomplete="current-password" />
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12 ml-2 mt-1">
                                    <p>
                                        <label>
                                            <input type="checkbox" />
                                            <span>Remember Me</span>
                                        </label>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button type="submit"
                                        class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Login</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6 m6 l6">
                                    <p class="margin medium-small">
                                        <a href="{{ route('register') }}">Register Now!</a>
                                    </p>
                                </div>
                                {{-- <div class="input-field col s6 m6 l6">
                                    <p class="margin right-align medium-small">
                                        <a href="user-forgot-password.html">Forgot password ?</a>
                                    </p>
                                </div> --}}
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
            title: 'Login gagal !',
            text: 'Username atau Password salah !',
        })
    </script>
    @endif
@endpush
