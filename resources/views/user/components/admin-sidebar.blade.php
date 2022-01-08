<?php
$get_user_details = \App\User::where(['id' => auth()->id()])->first();

$get_user = \App\User::where('id', auth()->id())->first();
// return $get_user;
$get_permission = \App\Vendor\RolePermission::where('role_id', $get_user->role_id)
    ->where('branch_id', $get_user->branch_id)
    ->first();

// return $get_permission;
$get_permission_id_one = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '1')
    ->first();
$get_permission_id_two = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '2')
    ->first();
$get_permission_id_three = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '3')
    ->first();
$get_permission_id_four = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '4')
    ->first();
$get_permission_id_five = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '5')
    ->first();
$get_permission_id_six = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '6')
    ->first();
$get_permission_id_seven = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '7')
    ->first();
$get_permission_id_eight = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '8')
    ->first();
$get_permission_id_nine = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '9')
    ->first();
$get_permission_id_ten = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '10')
    ->first();
$get_permission_id_eleven = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '11')
    ->first();
$get_permission_id_twelve = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '12')
    ->first();
$get_permission_id_thirteen = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '13')
    ->first();
$get_permission_id_fourteen = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '14')
    ->first();
$get_permission_id_27 = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '27')
    ->first();
$get_permission_id_28 = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '28')
    ->first();
$get_permission_id_31 = \App\Vendor\PermissionId::where('permission_role_id', @$get_permission->id)
    ->where('branch_id', @$get_permission->branch_id)
    ->where('role_id', @$get_permission->role_id)
    ->where('permission_id', '31')
    ->first();
?>
?>

<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow expanded" data-scroll-to-active="true"
    style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
    <div class="main-menu-content  ps--active-y">
        {{-- Vendor Dashboard Management --}}
        <ul class="navigation">
            <li class=""><a href="{{ route('user_dashboard') }}"><i
                        class="fas fa-chart-line"></i><span>Dashboard</span></a>
            </li>
        </ul>


        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item has-sub"><a href="#"><i class="fas fa-user-alt"></i><span class="menu-title"
                        data-i18n="Invoice">Profile</span></a>
                <ul class="menu-content" style="">
                    <li class=""><a class=" menu-item"
                            href="{{ route('user_profile.index') }}"><i></i><span data-i18n="Invoice Summary">User
                                Profile</span></a>
                    </li>
                </ul>
            </li>
        </ul>

        {{-- Vendor Branch Management --}}
        {{-- <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item has-sub"><a href="#"><i class="fas fa-code-branch"></i><span class="menu-title"
                        data-i18n="Invoice">Branch</span></a>
                <ul class="menu-content" style="">
                    @if ($get_permission_id_first)
                    <li class=""><a class=" menu-item"
                            href="{{ route('branch.create') }}"><i></i><span data-i18n="Invoice Summary">Add
                                Branch</span></a>
                    </li>
                    @endif
                    @if ($get_permission_id_two)

                    <li class=""><a class=" menu-item"
                            href="{{ route('branch.index') }}"><i></i><span data-i18n="Invoice Template">Branch
                                Listening</span></a>
                    </li>
                    @endif
                </ul>
            </li>
        </ul> --}}


        {{-- Vendor Role Management --}}
        {{-- <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item has-sub"><a href="#"><i class="fas fa-newspaper"></i><span class="menu-title"
                            data-i18n="Invoice">Role</span></a>
                    <ul class="menu-content" style="">
                        <li class=""><a class=" menu-item"
                                href="{{ route('branch_role.create') }}"><i></i><span data-i18n="Invoice Summary">Add
                                    Role</span></a>
                        </li>
                        <li class=""><a class=" menu-item"
                                href="{{ route('branch_role.index') }}"><i></i><span data-i18n="Invoice Template">Role
                                    Listing</span></a>
                        </li>
                    </ul>
                </li>
            </ul> --}}


        {{-- User Management --}}
        @if ($get_permission_id_one || $get_permission_id_two)
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item has-sub"><a href="#"><i class="fas fa-users-class"></i><span class="menu-title"
                            data-i18n="Invoice">User</span></a>
                    <ul class="menu-content" style="">
                        @if ($get_permission_id_one)
                            <li class=""><a class=" menu-item"
                                    href="{{ route('branch_user.create') }}"><i></i><span
                                        data-i18n="Invoice Summary">Add
                                        User</span></a>
                            </li>
                        @endif
                        @if ($get_permission_id_two)
                            <li class=""><a class=" menu-item"
                                    href="{{ route('branch_user.index') }}"><i></i><span
                                        data-i18n="Invoice Template">Users
                                        Listening</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        @endif


        {{-- User Management
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="navigation-header"><span data-i18n="User Interface">User</span><i class="la la-ellipsis-h"
                        data-toggle="tooltip" data-placement="right" data-original-title="User Interface"></i>
                </li>

                <li class="nav-item has-sub"><a href="#"><i class="fas fa-newspaper"></i><span class="menu-title"
                            data-i18n="Invoice">Article</span></a>
                    <ul class="menu-content" style="">
                        <li class=""><a class=" menu-item"
                                href="{{ route('article.create') }}"><i></i><span data-i18n="Invoice Summary">Add
                                    User</span></a>
                        </li>
                        <li class=""><a class=" menu-item"
                                href="{{ route('article.index') }}"><i></i><span data-i18n="Invoice Template">User
                                    Listing</span></a>
                        </li>
                    </ul>
                </li>
            </ul> --}}





        {{-- Patient Management --}}
        @if ($get_permission_id_three || $get_permission_id_four)
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item has-sub"><a href="#"><i class="fas fa-procedures"></i><span class="menu-title"
                            data-i18n="Invoice">Patient</span></a>
                    <ul class="menu-content" style="">
                        @if ($get_permission_id_three)
                            <li class=""><a class=" menu-item"
                                    href="{{ route('branch_patient.create') }}"><i></i><span
                                        data-i18n="Invoice Summary">Add
                                        Patient</span></a>
                            </li>
                        @endif
                        @if ($get_permission_id_four)
                            <li class=""><a class=" menu-item"
                                    href="{{ route('branch_patient.index') }}"><i></i><span
                                        data-i18n="Invoice Template">Patient
                                        Listing</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        @endif


        @if ($get_permission_id_five || $get_permission_id_six)
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item has-sub"><a href="#"><i class="fal fa-file-certificate"></i><span
                            class="menu-title" data-i18n="Invoice">Create Test</span></a>
                    <ul class="menu-content" style="">
                        @if ($get_permission_id_five)
                            <li class=""><a class=" menu-item"
                                    href="{{ route('branch-test-gig.create') }}"><i></i><span
                                        data-i18n="Invoice Summary">Add
                                        Test</span></a>
                            </li>
                        @endif
                        @if ($get_permission_id_six)
                            <li class=""><a class=" menu-item"
                                    href="{{ route('branch-test-gig.index') }}"><i></i><span
                                        data-i18n="Invoice Template">Test
                                        Listing</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        @endif



        {{-- Permission Management --}}
        @if ($get_permission_id_seven || $get_permission_id_eight)
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item has-sub"><a href="#"><i class="fas fa-key"></i><span class="menu-title"
                            data-i18n="Invoice">Permissions</span></a>
                    <ul class="menu-content" style="">
                        @if ($get_permission_id_seven)
                            <li class=""><a class=" menu-item"
                                    href="{{ route('branch_perission.create') }}"><i></i><span
                                        data-i18n="Invoice Summary">Add
                                        Permission</span></a>
                            </li>
                        @endif
                        @if ($get_permission_id_eight)
                            <li class=""><a class=" menu-item"
                                    href="{{ route('branch_perission.index') }}"><i></i><span
                                        data-i18n="Invoice Template">Permission
                                        Listing</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        @endif



        {{-- Expensive Report Management --}}
        @if ($get_permission_id_nine || $get_permission_id_ten)
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item has-sub"><a href="#"><i class="fad fa-money-check-edit-alt"></i><span
                            class="menu-title" data-i18n="Invoice">Expense Reports</span></a>
                    <ul class="menu-content" style="">
                        @if ($get_permission_id_nine)
                            <li class=""><a class=" menu-item"
                                    href="{{ route('branch_expensive_report.create') }}"><i></i><span
                                        data-i18n="Invoice Summary">Add
                                        Expense</span></a>
                            </li>
                        @endif
                        @if ($get_permission_id_ten)
                            <li class=""><a class=" menu-item"
                                    href="{{ route('branch_expensive_report.index') }}"><i></i><span
                                        data-i18n="Invoice Template">Expense
                                        Listing</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        @endif

        @if ($get_permission_id_eleven || $get_permission_id_twelve)
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item has-sub"><a href="#"><i class="far fa-money-bill-alt"></i><span
                            class="menu-title" data-i18n="Invoice">Profit Reports</span></a>
                    <ul class="menu-content" style="">
                        @if ($get_permission_id_eleven)
                            <li class=""><a class=" menu-item"
                                    href="{{ route('branch_profit_report.create') }}"><i></i><span
                                        data-i18n="Invoice Summary">Add
                                        Profit</span></a>
                            </li>
                        @endif
                        @if ($get_permission_id_twelve)
                            <li class=""><a class=" menu-item"
                                    href="{{ route('branch_profit_report.index') }}"><i></i><span
                                        data-i18n="Invoice Template">Profit
                                        Listing</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        @endif

        {{-- Add Test Management --}}
        {{-- @if ($get_permission_id_27 || $get_permission_id_28)
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item has-sub"><a href="#"><i class="fas fa-vials"></i></i><span class="menu-title"
                            data-i18n="Invoice">Invoice Creation</span></a>
                    <ul class="menu-content" style="">
                        @if ($get_permission_id_27)
                            <li class=""><a class=" menu-item"
                                    href="javascript:void(0)"><i></i><span
                                        data-i18n="Invoice Summary">Add
                                        Invoice</span></a>
                            </li>
                        @endif
                        @if ($get_permission_id_28)
                            <li class=""><a class=" menu-item"
                                    href="{{ route('branch_add_test.index') }}"><i></i><span
                                        data-i18n="Invoice Template">Invoice
                                        Listening</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        @endif --}}
        @if ($get_permission_id_27)
        <ul class="navigation">
            <li class=""><a href="{{ route('branch_add_test.index') }}"><i class="fas fa-receipt"></i><span>Create Invoice</span></a>
            </li>
        </ul>
        @endif

        @if ($get_permission_id_31 || $get_permission_id_thirteen)
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item has-sub"><a href="#"><i class="far fa-file-chart-line"></i></i><span
                            class="menu-title" data-i18n="Invoice">Patient Reports</span></a>
                    <ul class="menu-content" style="">

                        @if($get_permission_id_thirteen)
                        <li class=""><a href="{{ route('patient_invoice.index') }}"><i
                            class=""></i><span>Add Report</span></a>
                </li>
                        @endif
                        @if($get_permission_id_31)
                        <li class=""><a class=" menu-item"
                                href="{{ route('branch_patient_report.index') }}"><i></i><span
                                    data-i18n="Invoice Summary">Reports Listing</span></a>
                        </li>
                        @endif
                    </ul>
                </li>
            </ul>
        @endif


        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item has-sub"><a href="#"><i class="fas fa-files-medical"></i></i><span
                        class="menu-title" data-i18n="Invoice">Additional Reports</span></a>
                <ul class="menu-content" style="">
                    <li class=""><a href="{{ route('branch_additional_report.create') }}"><span>Add
                       Additional Report</span></a>
            </li>
                    <li class=""><a class=" menu-item"
                            href="{{ route('branch_additional_report.index') }}"><i></i><span
                                data-i18n="Invoice Summary">Additional Reports
                                Listing</span></a>
                    </li>

                </ul>
            </li>
        </ul>

        {{-- Test Report Management --}}

            {{-- @if ()
                <ul class="navigation">
                    <li class=""><a href="{{ route('patient_invoice.index') }}"><i
                                class="fas fa-file-chart-pie"></i><span>Add Report</span></a>
                    </li>
                </ul>
            @endif --}}


        {{-- Equipment Management --}}

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item has-sub"><a href="#"><i class="fad fa-tools"></i><span class="menu-title"
                        data-i18n="Invoice">Equipment Connected</span></a>
                <ul class="menu-content" style="">

                    <li class=""><a class=" menu-item" href="javascript:void(0)"><i></i><span
                                data-i18n="Invoice Summary">Add
                                Equipment</span></a>
                    </li>
                    <li class=""><a class=" menu-item" href="javascript:void(0)"><i></i><span
                                data-i18n="Invoice Template">Equipment
                                Listing</span></a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item has-sub"><a href="#"><i class="fas fa-history"></i><span class="menu-title"
                        data-i18n="Invoice">Machine Down Time</span></a>
                <ul class="menu-content" style="">

                    <li class=""><a class=" menu-item" href="javascript:void(0)"><i></i><span
                                data-i18n="Invoice Summary">Add Machine
                                Down Time</span></a>
                    </li>
                    <li class=""><a class=" menu-item" href="javascript:void(0)"><i></i><span
                                data-i18n="Invoice Template">Machine
                                Down Time Listing</span></a>
                    </li>
                </ul>
            </li>
        </ul>


        {{-- Category Management --}}
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 565px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 414px;"></div>
        </div>
    </div>
</div>
