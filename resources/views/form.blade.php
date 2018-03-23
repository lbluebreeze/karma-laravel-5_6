@extends('layout')

@section('content')
            <div class="row">
                <div class="col-lg-8">

                    <div class="promo-container">

                        <div class="promo1">
                            <p>En el mes de Marzo, nuestra compañía Karma celebramos la apertura de las nuevas sucursales de concesionarios en Bogotá.</p>
                        </div>
                        <div class="promo2">
                            <p>Sea partícipe de nuestro concurso en el que sortearemos un Volkswagen Jetta GLI Modelo 2019.</p>
                        </div>
                        <div class="promo3">
                            <p>¡Sólo registre sus datos para participar!</p>
                        </div>

                    </div>

                </div>
                <div class="col-lg-3">
                    {{ Form::model($model, ['url' => 'concursante/', 'method' => 'POST']) }}
                    <fieldset class="form">
                        <div class="h2">Karma</div>
                        {{ Form::text('nombre', $model->nombre, ['placeholder' => $model->getLabel('nombre'), 'id' => 'nombre']) }}
                        <div class="help-block"></div>
                        {{ Form::text('apellido', $model->apellido, ['placeholder' => $model->getLabel('apellido'), 'id' => 'apellido']) }}
                        <div class="help-block"></div>
                        {{ Form::text('cedula', $model->cedula, ['placeholder' => $model->getLabel('cedula'), 'id' => 'cedula']) }}
                        <div class="help-block"></div>
                        {{ Form::text('celular', $model->celular, ['placeholder' => $model->getLabel('celular'), 'id' => 'celular']) }}
                        <div class="help-block"></div>{{ Form::select('id_departamento', [null => '-- Departamento --'] + App\Departamento::pluck('nombre', 'id')->all(), $model->
                        id_departamento, ['id' => 'id_departamento']) }}
                        {{ Form::select('id_ciudad', [null => '-- Ciudad --'], $model->id_ciudad, ['id' => 'id_ciudad']) }}
                        <div class="help-block"></div>
                        {{ Form::text('email', $model->email, ['placeholder' => $model->getLabel('email'), 'id' => 'email', 'type' => 'email']) }}
                        <div class="help-block"></div>
                        <div class="habeas_data">
                            <label>
                                {{ Form::checkbox('habeas_data', $model->habeas_data, null, ['class' => 'checkbox']) }}
                                &nbsp;Autorizo el tratamiento de mis datos de acuerdo con la finalidad establecida en la política de protección de datos personales
                            </label>
                        </div>
                        {{ Form::submit('¡Enviar!', ['class' => 'btn btn-primary guardar']) }}
                    </fieldset>
                    {{ Form::close() }}
                </div>
            </div>
            <div id="mensaje" class="alert alert-success"></div>
            <script type="text/javascript">
               $('input[type="text"]').bind('keydown',function(e) {
                    var keypressed = e.which;
                    console.log(keypressed)
                    if(e.shiftKey && (keypressed >=48 && keypressed <= 57)) { 
                        e.preventDefault();
                        return false;
                    }
                    if ((keypressed >=65 && keypressed <= 90) || (keypressed >=48 && keypressed <= 57) || (keypressed >= 96 && keypressed <= 105)){
                    } else if ( keypressed === 8 || keypressed === 27 || keypressed === 46  || (keypressed >= 35 && keypressed <= 40) ) {
                    } else {
                        e.preventDefault();
                        return false;
                    }
                });
                $("#id_departamento").on('change', id_departamento_onchange);
                function id_departamento_onchange(){
                    $.ajax({
                        type: 'GET',
                        data: {'id': $("#id_departamento").val()},
                        dataType: 'text',
                        url: '{{ route('getciudades') }}',
                        beforeSend: function(){
                            $("#id_ciudad").html("<option value>Cargando...</option>");
                        },
                        success: function(data){
                            $("#id_ciudad").html(data);
                        },
                    });
                }
                id_departamento_onchange();
                @if (is_array(session('msj')))

                    $("#mensaje")
                        .removeClass()
                        .addClass('{{ session('msj')[0] }}')
                        .text('{{ session('msj')[1] }}')
                        .animate({
                            opacity: 1,
                            top: '8%'
                        })
                        .on('click', function(){
                            $(this).animate({
                                opacity: 0,
                                top: 0
                            });
                        });

                @endif

                @if ($errors->any())
                    @foreach ($errors->toArray() as $attr => $error)
                        $("#{{ $attr }}").next('.help-block').text('{{ $error[0] }}');
                    @endforeach
                @endif
            </script>
@endsection