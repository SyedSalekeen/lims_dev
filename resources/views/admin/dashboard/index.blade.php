<?php
$value = \App\User::where(['vendor_id' => auth()->id()])->get();
$vendors = count($value);
?>

@extends('admin.layouts.master')

@section('content')
    <!-- BEGIN: Content-->

    <!-- eCommerce statistic -->
<div>
    <a href="{{route('themes')}}">
    <div class="setting-top">
        <h4>Settings</h4>
        <i class="fas fa-cog"></i>
    </div>
    <a>
    <div class="doctor-profile">
        <div class="d-flex align-items-center">
            <div class="doctor-profile-img">
           <img src="data:image/png;base64,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" alt="">
            </div>
            <h3>Welcome to LIMSS</h3>
        </div>
        <div class="doctor-logo">
            {{-- <i class="fas fa-clinic-medical"></i> --}}
        </div>
        {{-- <div class="profile-seacrh-input">
            <input type="search" id="gsearch" name="gsearch">
            <i class="fas fa-search"></i>
        </div> --}}
    </div>
    <div class="card-row">
        <div class="row">

            <div class="col-lg-3">
                <a href="{{route('users.index')}}">
                <div class="card-patient">
                    <div>
                        <h2>Vendors<h2>
                    </div>
                    <div>
                        <i class="fad fa-users"></i>
                    </div>
                </div>
            </a>
            </div>

            <div class="col-lg-3">
                <div class="card-patient">
                    <a href="{{ route('Aggregate_Data.branches') }}">
                    <div>
                        <h2>Branches<h2>
                    </div>
                    <div>
                        {{-- <i class="fas fa-user-plus"></i> --}}
                        <i class="fas fa-code-branch"></i>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card-patient">
                    <a href="{{route('patient_show')}}">
                    <div>
                        <h2>Patients<h2>
                    </div>
                    <div>
                        <i class="fas fa-procedures"></i>
                    </div>
                    </a>
                </div>

            </div>
            <div class="col-lg-3">
                <div class="card-patient">
                    <a href="{{route('aggregate_data')}}" id="add_item">
                    <div>
                        <h2>Agregate Data<h2>
                    </div>
                    <div>
                        <i class="fad fa-database"></i>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
