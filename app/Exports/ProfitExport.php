<?php

namespace App\Exports;

use App\ProfitReport;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProfitExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // dd($);
        // return ProfitReport::all();
        return ProfitReport::select('id','profit_name','created_at','profit_amount','profit_description')->where('vendor_id', auth()->id())->get();

        // return ProfitReport::where('branch_id', auth()->id())->get();
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
