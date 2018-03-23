@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="ganador">
                <p>¡{{ $model->nombre . ' ' . $model->apellido }} eres el afortunado ganador de un Volkswagen Jetta GLI Modelo 2019!</p>
                <p>Pronto contactaremos con usted ¡Felicidades!</p>
            </div>
        </div>
    </div>
@endsection