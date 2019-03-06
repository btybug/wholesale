<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\User;

class UsersImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
//        return new User([
//            'name'     => $collection[0],
//            'email'    => $collection[1],
//        ]);

    }
}
