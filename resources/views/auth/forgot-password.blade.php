@extends('layouts.app')

@section('content')
@php 
    $pengaturan = DB::table('settings')->find(1);
@endphp
<div class="row">
      <div class="col s12">
        <div class="container"><div id="login-page" class="row">
            <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8" style="border-radius: 20px !important;">
                
                <form method="POST" action="{{ route('password.email') }}">
                @csrf
                
                <div class="row margin">
                <center><img src="{{ asset('upload/setting/'.$pengaturan->logo_besar) }}" alt="Chris Wood" class="img-fluid" style="height: 100px;max-width: 100%;max-height: 100%;margin-top:15px;pxmargin-bottom:15px" ></center>
                    
                    @if (session('status'))
                        <div class="card-alert card green">
                            <div class="card-content white-text">
                            <p>{{ session('status') }}</p>
                            </div>
                            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif


                    <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">email</i>
                    <input id="name" type="text"  name="email">
                    <label for="name" class="center-align">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                    <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-light-blue-cyan col s12">Reset Password</button>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 l12">
                    <p class="margin center-align medium-small"><a href="{{ url('/') }}">Login</a></p>
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