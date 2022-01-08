
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow expanded" data-scroll-to-active="true"
    style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
    <div class="main-menu-content ps ps--active-y">
        {{-- Vendor Dashboard Management --}}
        <ul class="navigation">
            <li class=""><a href="{{ route('patient_profile.index')}}"><i class="fas fa-user-alt"></i><span>Profile</span></a>
            </li>
        </ul>
        <ul class="navigation">
            <li class=""><a href="{{ route('patient_report.index')}}"><i class="fas fa-file-chart-pie"></i><span>Reports</span></a>
            </li>
        </ul>
        <ul class="navigation">
            <li class=""><a href="{{ route('patient_report.invoice')}}"><i
                        class="fas fa-chart-line"></i><span>Invoice</span></a>
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
