<?php

namespace App\Exports;

use App\Models\Event;
use App\Models\EventAddress;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventExport implements FromCollection, WithHeadings
{
	use Exportable;
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$event = Event::where('user_id',auth()->user()->id)->where('id',$this->data['id'])->first();
        $lists = EventAddress::where('event_id',$event->id)->orderBy('created_at', 'desc')->get();

		// Define the Excel spreadsheet headers
		// $exportArray[] = ['Role','Name','Email','Status'];

		if ($lists->count()) {
			foreach ($lists as $list) {
				//$exportArray[] = $user->toArray();
                $dob = $list->dob?date('Y-m-d', strtotime($list->dob)):null;
                if ($list->country) {
                    # code...
                }
				$exportArray[] = array($list->id, $list->name, $list->email, $list->phone_number, $list->dob, $list->addres1, $list->addres2, $list->city, $list->state, $list->countries->country_name, $list->pin_code, $list->additional_name, $list->no_guest, $list->notes, $list->created_at);
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
            'ID', 'Full Name', 'Email', 'Phone Number', 'Date of Birth', 'Address Line 1', 'Address Line 2', 'City', 'State', 'Country', 'Postal Code', 'Additional Name', 'Total Guest', 'Notes', 'Created'
        ];
    }
    
}
