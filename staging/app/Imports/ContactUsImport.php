<?php

namespace App\Imports;

use App\Models\Contact_us;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
class ContactUsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Remove the header row
        $rows->shift();

        foreach ($rows as $row) {
            // Assuming the columns in the Excel file are in the same order as your database columns
            $contactUsData = new Contact_us([
                'page_id' => 'excel',
                'first_name' => $row[1],
                'last_name' => $row[2],
                'email' => $row[3],
                'phone' => $row[4],
                'location' => $row[5],
                'service_name' => $row[6],
                'budget' => $row[7],
                'website' => $row[8],
                'skype' => $row[9],
                'whatsapp' => $row[10],
                'message' => $row[11],
                'created_at' => Carbon::now(),
                // Add more columns as necessary
            ]);

            $contactUsData->save();
        }
    }

}
