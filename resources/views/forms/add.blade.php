@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="card ExerOne mb-3">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Formular erstellen
                    </button>
                </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".ExerOne">
                <div class="card-body table-responsive">
                    {!! Form::open(array('route' => 'store-forms', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                    {!! csrf_field() !!}

                    <div class="form-group has-feedback row {{ $errors->has('form_name') ? ' has-error ' : '' }}">
                        {!! Form::label('form_name', 'Formularname', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('form_name', NULL, array('id' => 'form_name', 'class' => 'form-control', 'placeholder' => 'Formularname', 'required')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="group_name">
                                        <i class="fa fa-group" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('form_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('form_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback row {{ $errors->has('form_description') ? ' has-error ' : '' }}">
                        {!! Form::label('form_description', 'Formularbeschreibung', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::textarea('form_description', NULL, array('id' => 'form_description', 'class' => 'form-control', 'placeholder' => 'Formularbeschreibung', 'required')) !!}
                            </div>
                            @if ($errors->has('form_description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('form_description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {!! Form::button('Gruppe erstellen', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
