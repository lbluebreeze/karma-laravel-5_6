@php
	$data = $model->all()->toArray();
@endphp

<table>
	<tr>
		@foreach ($data[0] as $col => $row)
			@if ($col != 'id')
				<td><strong>{{ $model->getLabel($col) }}</strong></td>
			@endif
		@endforeach
	</tr>
	@foreach ($data as $key => $row)
		<tr>
			@foreach($row as $key => $col)
				@switch($key)
					@case('id')
						@break;
					@case('id_departamento')
						<td>{{ \App\Departamento::find($col)->nombre }}</td>
						@break;
					@case('id_ciudad')
						<td>{{ \App\Ciudad::find($col)->nombre }}</td>
						@break;
					@case('habeas_data')
					@case('ganador')
						<td>{{ ($col) ? 'Sí' : 'No' }}</td>
						@break;
					@default
						<td>{{ $col }}</td>
						@break;
				@endswitch
			@endforeach
		</tr>
	@endforeach
</table>