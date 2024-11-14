<?php

namespace App\Exports;

use App\Models\Forms;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Form2Export implements FromCollection, WithHeadings
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$lists = Forms::where('type','2')->orderBy('created_at', 'desc')->get();

		// Define the Excel spreadsheet headers
		// $exportArray[] = ['Role','Name','Email','Status'];

		if ($lists->count()) {
			foreach ($lists as $list) {
				//$exportArray[] = $user->toArray();
				$exportArray[] = array($list->id, $list->name, $list->email, $list->phone, $list->country, $list->expand, $list->help, $list->created_at);
			}
		}else{
			$exportArray = [];
		}
        return collect([$exportArray]);
        // return User::all();
    }

    public function headings(): array
    {
        return [
            'ID', 'Name', 'Email', 'Phone', 'What Country are you located', 'Where do you want to expand', 'How can We Help?', 'Created'
        ];
    }
    
}
