@extends('layouts')

@section('content2')


            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif


                <div class="card-header"> {{ __('Registro Único de Proveedores de Actividades Económicas de la provincia de Santa Cruz.') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div align="center">
                        <img src="logo_minpro.png" alt="Logo del Ministerio de la Producción, Comercio e Industria" title="Ministerio de la Producción, Comercio e Industria">
                    </div>

                </div>
@endsection
