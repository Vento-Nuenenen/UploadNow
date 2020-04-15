@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title">{{ config('app.name', 'Laravel') }}</h2>
                <p class="card-text">
                    Wilkommen bei UploadNow. <br />
                    Erstelle ein Formular, dass jeder ohne Anmeldung ausfüllen kann. <br />
                    <br />
                    Jeder mit dem Link kann das Formular ausfüllen. <br />
                </p>
            </div>
        </div>
@endsection
