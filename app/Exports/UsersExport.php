<?php

namespace App\Exports;

use App\Models\Stock;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Stock::all();
    }
}
