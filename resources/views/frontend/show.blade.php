@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="card mb-3">
            <div class="card-body">
                <h1 class="card-title">{{ $form->form_name }}</h1>
                <p class="card-text">
                    {{ $form->form_description }}
                </p>
                <hr />
                <br />
                <form method="post" action="{{ $form->form_hash }}/send" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="answerer_name">Vor & Nachname / nom et prénom / first & last name (Optional)</label>
                        <input type="text" class="form-control" id="answerer_name" name="answerer_name" aria-describedby="nameHelp" />
                    </div>

                    <div class="form-group">
                        <label for="email">E-Mail / Courrier électronique / e-mail (Optional)</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" />
                    </div>

                    <div class="form-group">
                        <label for="file">Datei / fichier / file (required)</label>
                        <div class="custom-file mb-3">
                            <input type="file" accept="audio/*,video/*" class="custom-file-input form-control" id="file" name="filename" aria-describedby="fileHelp" required />
                            <label class="custom-file-label" for="file">Choose file</label>
                        </div>
                        <small id="nameHelp" class="form-text text-muted">Maximum file size is 100 Megabyte!</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
@endsection
