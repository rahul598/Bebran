<?php

namespace App\Imports;

use App\Models\KeywordRanking;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
class KeywordImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Remove the header row
        $rows->shift();

        foreach ($rows as $row) {
            $keywordRankingData = new KeywordRanking([
                'excel_id' => 'keyword_ranking',
                'keyword' => $row[0],
                'previous_position' => $row[1],
                'created_at' => Carbon::now(),
            ]);
            $keywordRankingData->save();
        }
    }
}
