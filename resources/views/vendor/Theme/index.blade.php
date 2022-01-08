<style>
    .div-color-label {
        display: flex;
        flex-direction: column;
    }


    .div-color-label input {
        width: 100%;
        border-radius: 5px;
        padding: 5px 1rem;
        margin: 5px 0;
        border: 1px solid #f3f3f3;
        background: #f3f3f3;
    }

    .div-color-label input[type="text"] {
        padding: 10px 1rem;
    }

    .color-theme-h {
        padding: 2rem;
    }

    .color-theme-h h1 {
        color color: #383737;
        font-weight: 700;

    }

    .color-theme-h h2 {
        color: #1489e9;
        font-weight: 700;

    }

    .color-theme-h h3 {
        font-weight: 700;
    }

    .color-theme-h label {
        font-weight: 700;
        color: #1489e9;
    }

    .save-btns-theme-color {
        text-align: end;
    }

    .save-btns-theme-color button {
        border-radius: 25px;
        padding: 8px 30px;
        background-color: #0081a8;
        margin-top: 14px;
        color: #fff;
        font-weight: 700;
    }

    .save-btns-theme-color button:hover {
        background-color: #0081a8;
        color: #fff;
    }

    .color-theme-h select {
        border-radius: 9px;
        padding: 10px;
    }
    .tex-setting{
        display:flex;
        flex-direction:column;
        width: 30%;
    }
    .tex-setting select{
        padding:0 !important;
    }
    .tex-setting input{
      padding:5px 4px;
      outline: none;
      color: #495057;
      background-color: #ffffff;
      border: 1px solid #ced4da;
      border-radius: 9px;
    }
    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    color: #fff !important;
    background-color: #a82929 !important;
    border-color: #a82929 #a82929 #a82929 !important;
    }
    @media only screen and (max-width: 414px) {
        .tex-setting{
        width: 100%;
    }
    }



</style>
@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (Session::get('vendor_theme_saved'))
                <?php
                session()->forget('vendor_theme_saved');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Theme Has Been Changed' }}</p>
                </div>
            @endif
            @if (Session::get('vendor_theme_updated'))
                <?php
                session()->forget('vendor_theme_updated');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Theme Has Been Updated' }}</p>
                </div>
            @endif
            @if (Session::get('branch_theme_saved'))
                <?php
                session()->forget('branch_theme_saved');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Branch Theme Has Been Change' }}</p>
                </div>
            @endif
            @if (Session::get('branch_theme_updated'))
                <?php
                session()->forget('branch_theme_updated');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Branch Theme Has Been Updated' }}</p>
                </div>
            @endif
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

          <div class="card">
            <div class="color-theme-h">
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                   <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
                   <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                </div>
              </nav>
             <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
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
                    <form method="POST" action="{{ route('vendor_change_theme') }}">
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
                    <form method="POST" action="{{ route('branch_theme_change') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                                <h3>Branch Dashboard</h3>
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
                            {{-- <div class="col-lg-12">
                                <hr>
                                <h3>Font Themes</h3>
                            </div> --}}
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
                                    <select name="branch_id" id="cars" required="">
                                        <option selected disabled>Select Branch</option>
                                        @foreach ($get_branches as $item)
                                            <option value="{{ $item->id }}">{{ $item->branch_name }}</option>
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
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="row color-theme-h">
                    <div class="col-lg-12">
                        <h1>Theme Settings</h1>
                    </div>
                    <div class="col-lg-12 mt1">
                      <div class="tex-setting">
                        <label for="">Text input</label>
                        <input type="text" name="" id="">
                      </div>
                    </div>
                    <div class="col-lg-12 mt1">
                      <div class="tex-setting">
                             <label class="label-control" for="projectinput4">Marital status</label>
                                    <select class="form-control" id="select1" name="martial_status">
                                            <option selected disabled>Select marital status</option>
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                        </select>
                     </div>
                    </div>
                    <div class="col-lg-12">
                                <div class="save-btns-theme-color">
                                    <a href="#"><button class="btn">SAVE</button></a>
                                </div>
                    </div>
                </div>
              </div>
             </div>
            </div>
          </div>



                <!-- <div class="row color-theme-h">
                    <div class="col-lg-12">
                        <h1>Theme Settings</h1>
                    </div>
                    <div class="col-lg-12">
                        <h2>Color Pallette</h2>
                    </div>
                    <div class="col-lg-12 mt1">
                        <h3>Admin Dashboard</h3>
                    </div>
                    <form method="POST" action="{{ route('vendor_change_theme') }}">
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

                    <form method="POST" action="{{ route('branch_theme_change') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                                <h3>Branch Dashboard</h3>
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
                            {{-- <div class="col-lg-12">
                                <hr>
                                <h3>Font Themes</h3>
                            </div> --}}
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
                                    <select name="branch_id" id="cars" required="">
                                        <option selected disabled>Select Branch</option>
                                        @foreach ($get_branches as $item)
                                            <option value="{{ $item->id }}">{{ $item->branch_name }}</option>
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
                </div> -->
            </div>

            <!-- {{-- <div class="card">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Admin Theme Settings</h3>
                    </div>
                    <div class="col-lg-12">
                        <h5>Color Pallette</h5>
                    </div>

                </div>
            </div> --}} -->
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
