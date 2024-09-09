<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FileImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        public function collection(Collection $rows)
        {
            foreach ($rows as $row) 
            {
                User::create([
                    'name' => $row[0],
                ]);
            }
        }
    }
}
