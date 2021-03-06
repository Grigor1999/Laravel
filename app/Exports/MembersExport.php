<?php

namespace App\Exports;

use App\Models\Members;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class MembersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function view(): View
    {
        return view('exports.invoices', [
            'invoices' => Members::all()->toArray()
        ]);
    }
}
