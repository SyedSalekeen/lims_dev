<?php
$get_user_details = \App\User::where(['id' => auth()->id()])->first();
?>
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow expanded" data-scroll-to-active="true"
    style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
    <div class="main-menu-content  ps--active-y">


        @if ($get_user_details->type == '1')

            <ul class="navigation">
                <li class=""><a href="{{ route('dashboard') }}"><i
                            class="fas fa-store-alt"></i><span>Dashboard</span></a>
                </li>
            </ul>

            {{-- User Management && Role Management --}}
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                {{-- User Management --}}
                <li class="nav-item has-sub"><a href="#"><i class="fas fa-user"></i><span class="menu-title"
                            data-i18n="Invoice">Vendors</span></a>
                    <ul class="menu-content" style="">
                        <li class=""><a class=" menu-item"
                                href="{{ route('users.create') }}"><i></i><span data-i18n="Invoice Summary">Add
                                    Vendor</span></a>
                        </li>
                        <li class=""> <a class="menu-item"
                                href="{{ route('users.index') }}"><i></i><span data-i18n="Invoice Template"> Vendor
                                    Listing</span></a>
                        </li>
                    </ul>
                </li>
            </ul>


            {{-- Eqipment List --}}
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                {{-- User Management --}}
                <li class="nav-item has-sub"><a href="#"><i class="fad fa-tools"></i><span class="menu-title"
                            data-i18n="Invoice">Equipments</span></a>
                    <ul class="menu-content" style="">
                        <li class=""><a class=" menu-item" href="javascript:void(0)"><i></i><span
                                    data-i18n="Invoice Summary">Add
                                    Equipment</span></a>
                        </li>
                        <li class=""> <a class=" menu-item" href="javascript:void(0)"><i></i><span
                                    data-i18n="Invoice Template"> Equipment
                                    Listing</span></a>
                        </li>
                    </ul>
                </li>
            </ul>


        @endif

        @if ($get_user_details->type == '2')


            {{-- Vendor Dashboard Management --}}
            <ul class="navigation">
                <li class=""><a href="{{ route('vendor_dashboard') }}"><i
                            class="fas fa-chart-line"></i><span>Dashboard</span></a>
                </li>
            </ul>

            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item has-sub"><a href="#"><i class="fas fa-user-alt"></i><span class="menu-title"
                            data-i18n="Invoice">Profile</span></a>
                    <ul class="menu-content" style="">
                        <li class=""><a class=" menu-item"
                                href="{{ route('vendor_profile.edit') }}"><i></i><span
                                    data-i18n="Invoice Summary">Vendor Profile</span></a>
                        </li>
                    </ul>
                </li>
            </ul>

            {{-- Vendor Branch Management --}}
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item has-sub"><a href="#"><i class="fas fa-code-branch"></i><span class="menu-title"
                            data-i18n="Invoice">Branch</span></a>
                    <ul class="menu-content" style="">
                        <li class=""><a class=" menu-item"
                                href="{{ route('branch.create') }}"><i></i><span data-i18n="Invoice Summary">Add
                                    Branch</span></a>
                        </li>
                        <li class=""><a class=" menu-item"
                                href="{{ route('branch.index') }}"><i></i><span data-i18n="Invoice Template">Branch
                                    Listing</span></a>
                        </li>
                    </ul>
                </li>
            </ul>


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
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item has-sub"><a href="#"><i class="fas fa-users-class"></i><span class="menu-title"
                            data-i18n="Invoice">Create User</span></a>
                    <ul class="menu-content" style="">
                        <li class=""><a class=" menu-item"
                                href="{{ route('vendor_user.create') }}"><i></i><span data-i18n="Invoice Summary">Add
                                    User</span></a>
                        </li>
                        <li class=""><a class=" menu-item"
                                href="{{ route('vendor_user.index') }}"><i></i><span
                                    data-i18n="Invoice Template">Users
                                    Listing</span></a>
                        </li>
                    </ul>
                </li>
            </ul>


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







            {{-- Test Gig --}}
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item has-sub"><a href="#"><i class="far fa-notes-medical"></i><span
                            class="menu-title" data-i18n="Invoice">Create Test</span></a>
                    <ul class="menu-content" style="">
                        <li class=""><a class=" menu-item"
                                href="{{ route('test_gig.create') }}"><i></i><span data-i18n="Invoice Summary">Add
                                    Test
                                </span></a>
                        </li>
                        <li class=""><a class=" menu-item"
                                href="{{ route('test_gig.index') }}"><i></i><span data-i18n="Invoice Template">Test
                                    Listing</span></a>
                        </li>
                    </ul>
                </li>
            </ul>


            {{-- Patient  --}}
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item has-sub"><a href="#"><i class="fas fa-procedures"></i><span class="menu-title"
                            data-i18n="Invoice">Patient</span></a>
                    <ul class="menu-content" style="">
                        <li class=""><a class=" menu-item"
                                href="{{ route('patient.create') }}"><i></i><span data-i18n="Invoice Summary">Add
                                    Patient</span></a>
                        </li>
                        <li class=""><a class=" menu-item"
                                href="{{ route('patient.index') }}"><i></i><span data-i18n="Invoice Template">Patient
                                    Listing</span></a>
                        </li>
                    </ul>
                </li>
            </ul>



            {{-- Permission Management --}}
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item has-sub"><a href="#"><i class="fas fa-key"></i><span class="menu-title"
                            data-i18n="Invoice">Permissions</span></a>
                    <ul class="menu-content" style="">
                        <li class=""><a class=" menu-item"
                                href="{{ route('role_permission.create') }}"><i></i><span
                                    data-i18n="Invoice Summary">Add
                                    Permission</span></a>
                        </li>
                        <li class=""><a class=" menu-item"
                                href="{{ route('role_permission.index') }}"><i></i><span
                                    data-i18n="Invoice Template">Permission
                                    Listing</span></a>
                        </li>
                    </ul>
                </li>
            </ul>


            {{-- Role Management --}}
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item has-sub"><a href="#"><i class="fad fa-money-check-edit-alt"></i><span
                            class="menu-title" data-i18n="Invoice">Expense Reports</span></a>
                    <ul class="menu-content" style="">
                        <li class=""><a class=" menu-item"
                                href="{{ route('epensive_report.create') }}"><i></i><span
                                    data-i18n="Invoice Summary">Add
                                    Expense</span></a>
                        </li>
                        <li class=""><a class=" menu-item"
                                href="{{ route('epensive_report.index') }}"><i></i><span
                                    data-i18n="Invoice Template">Expense
                                    Listing</span></a>
                        </li>
                    </ul>
                </li>
            </ul>



            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item has-sub"><a href="#"><i class="far fa-money-bill-alt"></i><span
                            class="menu-title" data-i18n="Invoice">Profit Reports</span></a>
                    <ul class="menu-content" style="">
                        <li class=""><a class=" menu-item"
                                href="{{ route('profit_report.create') }}"><i></i><span
                                    data-i18n="Invoice Summary">Add
                                    Profit</span></a>
                        </li>
                        <li class=""><a class=" menu-item"
                                href="{{ route('profit_report.index') }}"><i></i><span
                                    data-i18n="Invoice Template">Profit
                                    Listing</span></a>
                        </li>
                    </ul>
                </li>
            </ul>



            {{-- Add Test Management --}}
            <ul class="navigation">
                <li class=""><a href="{{ route('add_test.index') }}"><i
                            class="fas fa-receipt"></i><span>Create Invoice</span></a>
                </li>
            </ul>






            {{-- Patient Report Management --}}
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item has-sub"><a href="#"><i class="fas fa-file-chart-pie"></i></i><span
                            class="menu-title" data-i18n="Invoice">Patient Reports</span></a>
                    <ul class="menu-content" style="">
                        <li class=""><a href="{{ route('vendor_add_report.index') }}"><span>Add
                            Report</span></a>
                </li>
                        <li class=""><a class=" menu-item"
                                href="{{ route('test_report.index') }}"><i></i><span
                                    data-i18n="Invoice Summary">Reports
                                    Listing</span></a>
                        </li>

                    </ul>
                </li>
            </ul>

            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item has-sub"><a href="#"><i class="fas fa-files-medical"></i></i><span
                            class="menu-title" data-i18n="Invoice">Additional Reports</span></a>
                    <ul class="menu-content" style="">
                        <li class=""><a href="{{ route('additional_report.create') }}"><span>Add
                           Additional Report</span></a>
                </li>
                        <li class=""><a class=" menu-item"
                                href="{{ route('additional_report.index') }}"><i></i><span
                                    data-i18n="Invoice Summary">Additional Reports
                                    Listing</span></a>
                        </li>

                    </ul>
                </li>
            </ul>

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


        @endif


        {{-- Category Management --}}


        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 565px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 414px;"></div>
        </div>
    </div>
</div>
