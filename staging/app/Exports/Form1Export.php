<?php

namespace App\Exports;

use App\Models\Forms;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Form1Export implements FromCollection, WithHeadings
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$lists = Forms::where('type','1')->orderBy('created_at', 'desc')->get();

		// Define the Excel spreadsheet headers
		// $exportArray[] = ['Role','Name','Email','Status'];

		if ($lists->count()) {
			foreach ($lists as $list) {
				//$exportArray[] = $user->toArray();
				$exportArray[] = array($list->id, $list->fname, $list->lname, $list->company, $list->function, $list->phone, $list->email, $list->help, $list->remark, $list->created_at);
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
            'ID', 'First Name', 'Last Name', 'Company', 'Company Headquaters', 'Phone', 'Email', 'How can We Help?', 'Remarks', 'Created'
        ];
    }
    
}
