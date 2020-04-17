@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="card Groups mb-3">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Alle Einträge zu {{ $form->form_name }}
                    </button>
                </h5>
            </div>
            <button onclick="location.href='{{ route('entries-download-all', $form->form_hash) }}'" type="button" class="btn btn-primary form-control mt-2">Download all</button>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".Groups">
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <th>
                            Name
                        </th>
                        <th>
                            E-Mail
                        </th>
                        <th>
                            Optionen
                        </th>
                        </thead>
                        <tbody>
                        @foreach($entries as $entry)
                            <tr>
                                <td>
                                    {{ $entry->answerer_name ?: 'No Answer' }}
                                </td>
                                <td>
                                    {{ $entry->email ?: 'No Answer' }}
                                </td>
                                <td>
                                    <button onclick="location.href='{{ route('entries-download',$entry->id) }}'" class="btn btn-danger ml-2"><span class="fa fa-download"></span></button>
                                    <button onclick="location.href='{{ route('entries-delete',$entry->id) }}'" class="btn btn-danger ml-2"><span class="fa fa-trash"></span></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
