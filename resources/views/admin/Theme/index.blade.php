
@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">

            @if (count($errors) > 0)
                <div class="alert round alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert my-2 alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="card">
                <div class="row color-theme-h">

                    <div class="col-lg-12">
                        <h1>Theme Settings</h1>
                    </div>
                    <div class="col-lg-12">
                        <h2>Color Pallette</h2>
                    </div>
                    <div class="col-lg-12 mt1">
                        <h3>Admin Dashboard</h3>
                    </div>
                    <form method="POST" action="{{ route('admin_theme_change') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3 mt1">
                                <div class="div-color-label">
                                    <label for="">Sidebar Color</label>
                                    <input type="text" value="#F5F5F5" id="PrimaryCode" class="colorInput" readonly>
                                    <input type="color" name="sidebar_color" id="PrimaryColor" class="colorInput"
                                        value="#F5F5F5">
                                </div>
                            </div>
                            <div class="col-lg-3 mt1">
                                <div class="div-color-label">
                                    <label for="">Navbar Color</label>
                                    <input type="text" value="#F05454" id="secondaryCode" class="colorInput" readonly>
                                    <input type="color" name="navbar_color" id="secondaryColor" class="colorInput"
                                        value="#F05454">
                                </div>
                            </div>
                            <div class="col-lg-3 mt1">
                                <div class="div-color-label">
                                    <label for="">Sidebar Text Color</label>
                                    <input type="text" value="#30475E" id="btnBgPrimaryCode" class="colorInput"
                                        readonly>
                                    <input type="color" name="sidebar_text" id="btnBgPrimary" class="colorInput"
                                        value="#30475E">
                                </div>
                            </div>
                            <div class="col-lg-3 mt1">
                                <div class="div-color-label">
                                    <label for="">Navbar Text Color</label>
                                    <input type="text" value="#121212" id="btnSecondaryCode" class="colorInput"
                                        readonly>
                                    <input type="color" name="navbar_text" id="btnSecondary" class="colorInput"
                                        value="#121212">
                                </div>
                            </div>
                            {{-- <div class="col-lg-12">
                                <hr>
                                    <h3>Font Themes</h3>
                                     </div> --}}
                            <div class="col-lg-3 mt1">
                                <div class="div-color-label">
                                    <label for="">Button Color</label>
                                    <input type="text" value="#FFFCDC" id="btnTextPrimaryCode" class="colorInput"
                                        readonly>
                                    <input type="color" name="button_color" id="btnTextPrimary" class="colorInput"
                                        value="#FFFCDC">
                                </div>
                            </div>
                            <div class="col-lg-3 mt1">
                                <div class="div-color-label">
                                    <label for="">Button Text Color</label>
                                    <input type="text" value="#FFE6BC" id="btnTextSecondaryCode" class="colorInput"
                                        readonly>
                                    <input type="color" name="button_text" id="btnTextSecondary" class="colorInput"
                                        value="#FFE6BC">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="save-btns-theme-color">
                                    <a href="#"><button class="btn">SAVE</button></a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('laboratory_theme_change') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                                <h3>Laboratory Dashboard</h3>
                            </div>
                            <div class="col-lg-3 mt1">
                                <div class="div-color-label">
                                    <label for="">Sidebar Color</label>
                                    <input type="text" value="#F5F5F5" id="PrimaryCode1" class="colorInput1" readonly>
                                    <input type="color" name="sidebar_color" id="PrimaryColor1" class="colorInput1"
                                        value="#F5F5F5">
                                </div>
                            </div>
                            <div class="col-lg-3 mt1">
                                <div class="div-color-label">
                                    <label for="">Navbar Color</label>
                                    <input type="text" value="#F05454" id="secondaryCode1" class="colorInput1" readonly>
                                    <input type="color" name="navbar_color" id="secondaryColor1" class="colorInput1"
                                        value="#F05454">
                                </div>
                            </div>
                            <div class="col-lg-3 mt1">
                                <div class="div-color-label">
                                    <label for="">Sidebar Text Color</label>
                                    <input type="text" value="#30475E" id="btnBgPrimaryCode1" class="colorInput1"
                                        readonly>
                                    <input type="color" name="sidebar_text" id="btnBgPrimary1" class="colorInput1"
                                        value="#30475E">
                                </div>
                            </div>
                            <div class="col-lg-3 mt1">
                                <div class="div-color-label">
                                    <label for="">Navbar Text Color</label>
                                    <input type="text" value="#121212" id="btnSecondaryCode1" class="colorInput1"
                                        readonly>
                                    <input type="color" name="navbar_text" id="btnSecondary1" class="colorInput1"
                                        value="#121212">
                                </div>
                            </div>
                            <div class="col-lg-3 mt1">
                                <div class="div-color-label">
                                    <label for="">Button Color</label>
                                    <input type="text" value="#FFFCDC" id="btnTextPrimaryCode1" class="colorInput1"
                                        readonly>
                                    <input type="color" name="button_color" id="btnTextPrimary1" class="colorInput1"
                                        value="#FFFCDC">
                                </div>
                            </div>
                            <div class="col-lg-3 mt1">
                                <div class="div-color-label">
                                    <label for="">Button Text Color</label>
                                    <input type="text" value="#FFE6BC" id="btnTextSecondaryCode1" class="colorInput1"
                                        readonly>
                                    <input type="color" name="button_text" id="btnTextSecondary1" class="colorInput1"
                                        value="#FFE6BC">
                                </div>
                            </div>
                            <div class="col-lg-3 mt1">
                                <div class="div-color-label">
                                    <label for="">Select Branch</label>
                                    <select name="laboratory_id" id="cars" required="">
                                        <option selected disabled>Select Laboratory</option>
                                        @foreach ($get_laborities as $item)
                                            <option value="{{ $item->id }}">{{ $item->laboratory_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="save-btns-theme-color">
                                    <a href="#"><button class="btn">SAVE</button></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('scripts')
    <script>
        // vendor color changing options
        $("input[class*='colorInput']").on("input", function() {
            var elem = $("input[class*='colorInput']")
            var names = [];
            for (var i = 0; i < elem.length; ++i) {
                names.push(elem[i].value);
            }
            var PrimaryColor = names[1];
            var secondaryColor = names[3];
            var btnBgPrimary = names[5];
            var btnSecondary = names[7];
            var btnTextPrimary = names[9];
            var btnTextSecondary = names[11];
            if (elem[1].attributes.id = "PrimaryColor") {
                $("#PrimaryCode").val(PrimaryColor)
            }
            if (elem[3].attributes.id = "secondaryColor") {
                $("#secondaryCode").val(secondaryColor)
            }
            if (elem[5].attributes.id = "btnBgPrimary") {
                $("#btnBgPrimaryCode").val(btnBgPrimary)
            }
            if (elem[7].attributes.id = "btnSecondary") {
                $("#btnSecondaryCode").val(btnSecondary)
            }
            if (elem[9].attributes.id = "btnTextPrimary") {
                $("#btnTextPrimaryCode").val(btnTextPrimary)
            }
            if (elem[11].attributes.id = "btnTextSecondary") {
                $("#btnTextSecondaryCode").val(btnTextSecondary)
            }
        })
        // branch color changing options
        $("input[class*='colorInput1']").on("input", function() {
            var elem = $("input[class*='colorInput1']")
            var names = [];
            for (var i = 0; i < elem.length; ++i) {
                names.push(elem[i].value);
            }
            var PrimaryColor = names[1];
            var secondaryColor = names[3];
            var btnBgPrimary = names[5];
            var btnSecondary = names[7];
            var btnTextPrimary = names[9];
            var btnTextSecondary = names[11];
            if (elem[1].attributes.id = "PrimaryColor1") {
                $("#PrimaryCode1").val(PrimaryColor)
            }
            if (elem[3].attributes.id = "secondaryColor1") {
                $("#secondaryCode1").val(secondaryColor)
            }
            if (elem[5].attributes.id = "btnBgPrimary1") {
                $("#btnBgPrimaryCode1").val(btnBgPrimary)
            }
            if (elem[7].attributes.id = "btnSecondary1") {
                $("#btnSecondaryCode1").val(btnSecondary)
            }
            if (elem[9].attributes.id = "btnTextPrimary1") {
                $("#btnTextPrimaryCode1").val(btnTextPrimary)
            }
            if (elem[11].attributes.id = "btnTextSecondary1") {
                $("#btnTextSecondaryCode1").val(btnTextSecondary)
            }
        })
    </script>
@endsection
