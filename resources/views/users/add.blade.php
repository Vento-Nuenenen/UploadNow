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

        <div class="card AddUser mb-3">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Neuer Benutzer
                    </button>
                </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".ExerOne">
                <div class="card-body">
                    {!! Form::open(array('route' => 'store-users', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                    {!! csrf_field() !!}

                    <div class="form-group has-feedback row {{ $errors->has('scout_name') ? ' has-error ' : '' }}">
                        {!! Form::label('scout_name', 'Pfadiname', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('scout_name', NULL, array('id' => 'scout_name', 'class' => 'form-control', 'placeholder' => 'Pfadiname')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="scout_name">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('scout_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('scout_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback row {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                        {!! Form::label('first_name', 'Vorname', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('first_name', NULL, array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'Vorname', 'required')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="first_name">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback row {{ $errors->has('last_name') ? ' has-error ' : '' }}">
                        {!! Form::label('last_name', 'Nachname', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('last_name', NULL, array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Nachname', 'required')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="last_name">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                        {!! Form::label('email', 'E-Mail', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => 'E-Mail', 'required')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="email">
                                        <i class="fa fa-mail-forward" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback row {{ $errors->has('password') ? ' has-error ' : '' }}">
                        {!! Form::label('password', 'Passwort', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::password('password', array('id' => 'password', 'class' => 'form-control', 'placeholder' => 'Passwort', 'required')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="password">
                                        <i class="fa fa-key" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback row {{ $errors->has('password_repeat') ? ' has-error ' : '' }}">
                        {!! Form::label('password_repeat', 'Passwort wiederholen', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::password('password_repeat', array('id' => 'password_repeat', 'class' => 'form-control', 'placeholder' => 'Passwort wiederholen', 'required')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="password_repeat">
                                        <i class="fa fa-key" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('password_repeat'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_repeat') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {!! Form::button('Benutzer erstellen', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
