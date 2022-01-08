<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            margin-left: -47px;
            margin-right: 0;
            padding: 0;
            width: 790px;
            border-right-color: #ffffff;
            font-size: 18px;
            border-collapse: collapse;
        }

        .row1 {
            text-align: right !important;
        }

        .row2 {
            width: 100%;
            text-align: right !important;
        }

        .font-style {
            font: 700;
            font-size: 26px;
            color: rgb(34, 34, 34);
        }

        tbody tr:nth-child(odd) {
            background-color: #e9ecef;
        }

        tbody th {
            ;
        }

        tbody tr:nth-child(even) {
            background-color: #e9ecef;
        }

    </style>
</head>

<body style="margin:50px 0;">
    <table style="text-align: center;">
        <thead>
            <tr>
                @if ($get_vendor->laboratory_logo)
                    <td style="width: 230px; height: 100px">
                        <img id="output" style="object-fit: cover; width: 100%; height: 100%;"
                            src="{{ asset('uploads/logo/' . $get_vendor->laboratory_logo) }}" width='100%'
                            height='100%' />
                    </td>
                @else
                    <td>
                        <h1>
                            {{ $get_vendor->laboratory_name }}
                        </h1>
                    </td>
                @endif
            </tr>
        </thead>
    </table>

    <table style="background-color: #fff !important; margin-top: 20px; margin-bottom: 20px">
        <tr style="background-color: #fff !important;">
            <td style="padding-left:20px; font-size: 25px">
                Laboratory Name: {{ $get_vendor->laboratory_name }}
            </td>
        </tr>
        <tr style="background-color: #fff !important;">
            <td style="padding-left:20px; font-size: 20px">
                Branch Name: {{ $get_branch->branch_name }}
            </td>
        </tr>

    </table>

    <table style="background-color: #fff !important; margin-top: 20px; margin-bottom: 20px">
        <tr style="background-color: #fff !important;">
            {{-- <td style="padding-left:20px; font-size: 15px">
                Rasen Medical Labortory - Qatif
            </td> --}}
            <td style="padding-left: 30px; font-size: 15px">
                E-mail: {{ $get_vendor->email }}
            </td>
            <td style="padding-left:10px; font-size: 15px">
                Phone: {{ $get_vendor->contact_number }}
            </td>
        </tr>

    </table>

    <table style="text-align: center; margin-top: 20px; margin-bottom: 20px">
        <tr style="background-color: #fff !important;">
            <td style="font-size: 25px;  font-weight:600">
                LABORATORY REPORT
            </td>

        </tr>
    </table>
    <table style="background-color: #fff !important; margin-top: 15px; margin-bottom: 10px; ">
        <tr style="background-color: #fff !important;">
            <td style="padding-left: 20px">
                MR NUMBER:
            </td>
            <td>
                {{ $get_patient->id }}
            </td>

            <td>
                Report Status:
            </td>
            <td>
                Final Report
            </td>
        </tr>
        <tr style="background-color: #fff !important;">
            <td style="padding-left: 20px">
                Patient Name:
            </td>
            <td>
                {{ $get_patient->fullname }}
            </td>

            <td>
                Mobile No:
            </td>
            <td>
                {{ $get_patient->contact_number }}
            </td>
        </tr>
        <tr style="background-color: #fff !important;">
            <td style=" border-bottom:1px solid rgb(37, 37, 37); padding-left: 20px; padding-bottom: 10px">
                Gender
            </td>
            <td style=" border-bottom:1px solid rgb(37, 37, 37);  padding-bottom: 10px">
                {{ $get_patient->sex }}
            </td>
            <td style=" border-bottom:1px solid rgb(37, 37, 37);  padding-bottom: 10px">
                Clinic File No:
            </td>
            <td style=" border-bottom:1px solid rgb(37, 37, 37);  padding-bottom: 10px">
                none
            </td>

        </tr>
        {{-- <tr style="background-color: #fff !important;">
               <td style="padding-left: 20px; border-bottom:1px solid rgb(37, 37, 37);"  >
                  Referral Clinic:
               </td>
               <td style=" border-bottom:1px solid rgb(37, 37, 37);" >
                  Rasen Medical Laboratory
               </td>


        </tr> --}}
    </table>

    <table style="text-align: center; margin-top: 25px; margin-bottom: 20px">
        <tr style="background-color: #fff !important;">
            <td style="font-size: 25px;  border-bottom:1px solid rgb(37, 37, 37);">
                Test Report
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th scope="col"
                    style=" background-color: #e9ecef;border-bottom:1px solid rgb(37, 37, 37);text-align:left;padding-left: 20px ">
                    Test Name</th>
                <th scope="col"
                    style=" background-color: #e9ecef;border-bottom:1px solid rgb(37, 37, 37);text-align:left;padding-left: 20px ">
                    Units</th>
                <th scope="col"
                    style=" background-color: #e9ecef;border-bottom:1px solid rgb(37, 37, 37);text-align:left;padding-left: 20px">
                    Test Best Range</th>

                <th scope="col"
                    style=" background-color: #e9ecef;border-bottom:1px solid rgb(37, 37, 37);text-align:left;padding-left: 20px">
                    Result</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($reportDetails as $item)
                <tr>
                    <th scope="row" style="padding: 8px 0px ; text-align:left;padding-left: 20px;; font-weight:400">
                        {{ $item->test_name }}</th>
                    <td style="text-align:left;padding-left: 20px">{{ $item->test_unit }}</td>
                    <td style="text-align:left;padding-left: 20px">{{ $item->test_best_range }}</td>

                    <td style="text-align:left;padding-left: 20px">{{ $item->test_result }}</td>
                </tr>
            @endforeach


        </tbody>
    </table>

    <!--<table style="padding:0 10px;" >-->
    <!--    <thead>-->
    <!--        <tr>-->
    <!--            <td></td>-->
    <!--            <td class="row2">Generated By:</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td style="width: 50%"></td>-->
    <!--            <td class="row2 font-style">{{ $get_vendor->laboratory_name }}</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td  class="font-style"  style="width:50%"></td>-->
    <!--            <td class="row2">{{ $get_branch->branch_name }}</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td></td>-->
    <!--            <td class="row2">+92-30245-300</td>-->
    <!--        </tr>-->
    <!--    </thead>-->
    <!--</table>-->
    <!--<table style="margin-top:2rem;padding: 10px">-->
    <!--    <thead>-->
    <!--        <tr>-->
    <!--            <td class="font-style">Report#880</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td>Report Issue Date:16-12-2021</td>-->
    <!--        </tr>-->
    <!--    </thead>-->
    <!--</table>-->
    <!--<table class="table" style="width: 800px; margin-top:2rem; padding: 10px; background-color: #e9ecef">-->
    <!--    <thead>-->
    <!--      <tr>-->
    <!--        <th scope="col" style=" background-color: #e9ecef; padding:10px 0; border-bottom:1px solid rgb(37, 37, 37);">#</th>-->
    <!--        <th scope="col" style=" background-color: #e9ecef;border-bottom:1px solid rgb(37, 37, 37);">Patient Name</th>-->
    <!--        <th scope="col" style=" background-color: #e9ecef;border-bottom:1px solid rgb(37, 37, 37);">MR NUMBER</th>-->
    <!--        <th scope="col" style=" background-color: #e9ecef;border-bottom:1px solid rgb(37, 37, 37); ">Test Name</th>-->
    <!--        <th scope="col" style=" background-color: #e9ecef;border-bottom:1px solid rgb(37, 37, 37);">Test Best Range</th>-->
    <!--        <th scope="col" style=" background-color: #e9ecef;border-bottom:1px solid rgb(37, 37, 37); ">Test Result</th>-->
    <!--      </tr>-->
    <!--    </thead>-->
    <!--    <tbody>-->
    <!--      <tr>-->
    <!--        <th scope="row" style="padding: 6px 2px;text-align:center;">1</th>-->
    <!--        <td style="text-align:center;">Mark</td>-->
    <!--        <td style="text-align:center;">Otto</td>-->
    <!--        <td style="text-align:center;">@mdo</td>-->
    <!--        <td style="text-align:center;">Otto</td>-->
    <!--        <td style="text-align:center;">@mdo</td>-->
    <!--      </tr>-->
    <!--      <tr>-->
    <!--        <th scope="row"  style="padding: 6px 2px;text-align:center;">2</th>-->
    <!--        <td style="text-align:center;">Jacob</td>-->
    <!--        <td style="text-align:center;">Thornton</td>-->
    <!--        <td style="text-align:center;">@fat</td>-->
    <!--        <td style="text-align:center;">Otto</td>-->
    <!--        <td style="text-align:center;">@mdo</td>-->
    <!--      </tr>-->

    <!--    </tbody>-->
    <!--</table>-->
</body>

</html>
