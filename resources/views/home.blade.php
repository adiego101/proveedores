@extends('layouts')

@section('content2')


            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif


                <div class="card-header"> {{ __('Registro Único de Proveedores del Estado Provincial.') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div align="center">
                        <img src="logo-mefi.png" alt="Logo del Registro Único de Proveedores del Estado Provincial" title="Registro Único de Proveedores del Estado Provincial">
                    </div>

                </div>
@endsection
