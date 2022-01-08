<?php

namespace App\Exports;

use App\ProfitReport;
use App\User;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BranchProfitExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $get_auth_user = User::find(auth()->id());
        return ProfitReport::select('id','profit_name','created_at','profit_amount','profit_description')->where('branch_id', $get_auth_user->branch_id)->get();
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
