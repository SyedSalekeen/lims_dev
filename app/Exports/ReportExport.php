<?php

namespace App\Exports;

use App\ExpensiveReport;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // dd(ExpensiveReport::all());

        return ExpensiveReport::select('id','expensive_name','created_at','expensive_amount','expensive_description')->where('vendor_id', auth()->id())->get();

    }

    public function headings(): array
    {
        return [
            [
                'ID',
                'Name',
                'Date & Time',
                'Amount(+/-)',
                'Description',

            ],
        ];
    }


}
