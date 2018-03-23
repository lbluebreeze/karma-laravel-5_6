<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CiudadController extends Controller
{
    public function getCiudades()
    {
    	$id = $_GET['id'];

    	echo "<option>-- Ciudad --</option>\r";
    	foreach (\App\Ciudad::where(['id_departamento' => $id])->pluck('nombre', 'id') as $key => $value) {
    		$model = session('Concursante');
    		$selected = ($model->id_ciudad == $key) ? 'selected' : '';
    		echo "<option value='$key' $selected>$value</option>\r";
    	}
    }
}
