<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Validation\Rule;

class Concursante extends Model
{
	public $table = 'concursante';
	public $timestamps = false;
	private $errors;
	protected $fillable = ['nombre', 'apellido', 'cedula', 'celular', 'id_departamento', 'id_ciudad', 'email', 'habeas_data'];

	private $labels = [
		'id' => 'ID',
		'fecha_creacion' => 'Fecha Creación',
		'nombre' => 'Nombre',
		'apellido' => 'Apellido',
		'cedula' => 'Cedula',
		'celular' => 'Celular',
		'id_departamento' => 'Departamento',
		'id_ciudad' => 'Ciudad',
		'email' => 'Correo Electrónico',
		'habeas_data' => 'Autorización',
		'ganador' => 'Ganador'
	];

	public function rules()
	{
		return [
			'nombre' => 'required|max:100',
			'apellido' => 'required|max:100',
			'cedula' => 'required|max:20',
			'celular' => 'required|max:30',
			'habeas_data' => 'max:30',
			'id_departamento' => [
				'required',
				'integer',
				Rule::exists('departamento', 'id')->where(function($query) {
					$query->where('id', $this->id_departamento);
				}),
			],
			'id_ciudad' => [
				'required',
				'integer',
				Rule::exists('ciudad', 'id')->where(function($query) {
					$query->where('id', $this->id_ciudad);
				}),
			],
			'email' => 'required|max:100|email',
		];
	}

	public function getLabel($attr)
	{
		return (isset($this->labels[$attr])) ? $this->labels[$attr] : $attr;
	}

	public function getDepartamento()
	{
		return $this->hasOne('App\Departamento', 'id', 'id_departamento');
	}

	public function getCiudad()
	{
		return $this->hasOne('App\Ciudad', 'id', 'id_ciudad');
	}

	public function validate($data)
	{
		$v = Validator::make($data, $this->rules());
		if ($v->fails()) {
			$this->errors = $v->errors();
			return false;
		}
		return true;
	}

	public function errors()
	{
		return $this->errors;
	}

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

}
