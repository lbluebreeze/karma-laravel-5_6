<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use App\Concursante;

class ConcursanteExport implements FromView, Responsable
{
	use Exportable;
	private $fileName = 'concursantes.xlsx';

	public function view(): View
	{
		return view('exports.concursante', ['model' => new Concursante]);
	}
}
?>