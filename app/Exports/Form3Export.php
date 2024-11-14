<?php

namespace App\Exports;
use File;

use App\Models\Forms;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Form3Export implements FromCollection, WithHeadings
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$lists = Forms::where('type','3')->orderBy('created_at', 'desc')->get();

		// Define the Excel spreadsheet headers
		// $exportArray[] = ['Role','Name','Email','Status'];

		if ($lists->count()) {
			foreach ($lists as $list) {
				//$exportArray[] = $user->toArray();
                $resume = ($list->resume && File::exists(public_path('uploads/'.$list->resume))) ? asset('/uploads/'.$list->resume) : '' ;
				$exportArray[] = array($list->id, $list->name, $list->email, $list->phone, $list->position, $list->experience, $list->located, $list->country, $resume, $list->created_at);
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
            'ID', 'Name', 'Email', 'Phone', 'Position Applying For', 'Experience in Years', 'Preferred Job Location', 'Region/Country', 'Resume', 'Created'
        ];
    }
    
}
