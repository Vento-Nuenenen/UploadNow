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
            <button>Download all</button>
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
                            Download
                        </th>
                        </thead>
                        <tbody>
                        @foreach($entries as $entry)
                            <tr>
                                <td>
                                    {{ null !== $entry->answerer_name ?: 'No Answer' }}
                                </td>
                                <td>
                                    {{ null !== $entry->email ?: 'No Answer' }}
                                </td>
                                <td>
                                    <button onclick="location.href='{{ route('entries-download',$entry->id) }}'" class="btn btn-danger ml-2"><span class="fa fa-download"></span></button>
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
