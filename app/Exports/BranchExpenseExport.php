<?php

namespace App\Exports;

use App\User;
use App\ExpensiveReport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use DB;

class BranchExpenseExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // ->whereRaw ('date(created_at) = ?', [Carbon::now()->format('Y-m-d')] )
        // 'date(created_at) = ?', [Carbon::now()->format('Y-m-d')]

        $get_auth_user = User::find(auth()->id());
        return ExpensiveReport::select('id','expensive_name','created_at','expensive_amount','expensive_description')->where('branch_id', $get_auth_user->branch_id)->get();
    }
    public function headings(): array
    {
        return [

            // [$date = Carbon::now()->format('d-M-Y h:i A')],
            [
                'ID',
                'Name',
                'Date & Time',
                'Amount(+/-)',
                'Description',

            ],

        ];
    }


    // $keyed = new Collection($keyed);
    // return $keyed;

    // $keyed[] = [
    //     'Inv #' => $history->invoice_no,
    //     'Piv #' => "----",
    //     'Amount' => $history->total_amount,
    //     'Amount(+/-)' => $history->deposit_to_account,
    //     'Voucher #' => $history->type . '-' . $history->id,
    //     'Date & Time' => date_format(date_create($history->created_at),'d-M-Y g:i A'),
    //     'Advance' => '(+)'.$history->receive_amount,
    //     'Balance Due' => $history->temp_balance_due,
    // ];

}
