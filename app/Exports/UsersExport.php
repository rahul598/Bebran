<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$activeuser = User::select('users.name','users.email','users.status','roles.display_name')
		->join('roles', 'users.role_id', '=', 'roles.id')
		->where('users.status','1')->get();

		// Define the Excel spreadsheet headers
		// $exportArray[] = ['Role','Name','Email','Status'];

		if ($activeuser->count()) {
		foreach ($activeuser as $user) {
			//$exportArray[] = $user->toArray();
			$status1 = ($user->status==1) ? 'Active' : 'In-active' ;
			$name = explode(' ', $user->name);
			$fname = $name[0];
			$lname = ltrim($user->name,$name[0]);
			$exportArray[] = array($user->email,$fname,$lname);
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
            'Email Address',
            'First Name',
            'Last name',
        ];
    }
    
}
