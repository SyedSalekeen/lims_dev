<!-- CUSTOM JS HERE -->
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert-success').fadeOut(1500);
            $('.alert-danger').fadeOut(1500);
        }, 4000)
    });
</script>
<script>
    $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
@stack('scripts')
<!-- CUSTOM JS HERE -->

<!-- BEGIN: Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/charts/chartist.min.js') }}"></script>
{{-- <script src="{{asset('app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js')}}"></script> --}}
<script src="{{ asset('app-assets/vendors/js/charts/raphael-min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/charts/morris.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/timeline/horizontal-timeline.js') }}"></script>
<!-- END: Page Vendor JS-->

{{-- <script src="{{asset('app-assets/data/locales/en.json')}}"></script> --}}

{{-- toaster --}}
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{-- end of toaster --}}

<!-- BEGIN: Theme JS-->
<script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('app-assets/js/core/app.js') }}"></script>
<!-- END: Theme JS-->

{{-- main js --}}
<script src="{{ asset('js/main.js') }}"></script>

{{-- dropyfiy js --}}
<script src="{{asset('js/dropify.js')}}"></script>
<script src="{{asset('js/dropify.min.js')}}"></script>


{{-- Select2 --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</body>
<!-- END: Body-->
</html>
