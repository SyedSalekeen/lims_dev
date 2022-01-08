<?php
$email = session()->get('vendor_email');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LIMS</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{asset('app-assets/css/style.css')}}">
    @if ($get_color)
        <style>
            :root {
                --secondary-sidebar-bg-color: {{ $get_color['sidebar_color'] }};
                --secondary-button-text-color: {{ $get_color['sidebar_text'] }};

            }


.mainDiv.my-scrollbar {
    padding-top: 200px;
    min-height: 100vh;
}

.mainDiv.my-scrollbar .main {
    background: #fff !important;
    height: 100%;
}


/* verification input */
#wrapper {
    font-family: Lato;
    font-size: 1.5rem;
    text-align: center;
    box-sizing: border-box;
    color: #333;
}

#wrapper #dialog h3 {
    margin: 0 0 10px;
    padding: 0;
    line-height: 1.25;
}

#wrapper #dialog span {
    font-size: 90%;
}

#wrapper #dialog #form {
    width: 100%;
}

#wrapper #dialog #form input {
    margin: 0;
    text-align: center;
    font-size: 44px;
    border: none;
    outline: none;
    width: 9%;
    border-radius: 50%;
    font-weight: 700;
    font-family: 'gilroyblack';
    color: var(--secondary-sidebar-bg-color);
    position: relative;
}

#wrapper #dialog #form input::after {
    content: '-';
    position: absolute;
    top: 0;
    left: 0;
}

#wrapper #dialog #form input::selection {
    background: transparent;
}

#wrapper #dialog button.close {
    border: solid 2px;
    border-radius: 30px;
    line-height: 19px;
    font-size: 120%;
    width: 22px;
    position: absolute;
    right: 5px;
    top: 5px;
}

#wrapper #dialog div input {
    background: #efeff3;
}

.ver-code-inp {
    background: #fff;
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;

}

.withFith {
    display: flex;
    justify-content: center;
    text-align: center;
    align-items: center;
}

.lims_heading {
    font-size: 3rem;
    text-align: center;
    color: var(--secondary-sidebar-bg-color);
    font-weight: 700;
    margin-top: 1.4rem;
}

.signupbotton {
    padding: 6px 45px;
    background: var(--secondary-sidebar-bg-color)!important;
    font-family: gilroyblack;
    color: var(--secondary-button-text-color) !important;
    border: none;
    font-weight: 700;
    border-radius: 50px;
    font-size: 24px;
}

.alert_message {
    margin: 10px !important;
}

.for-color-back {
    background: var(--secondary-sidebar-bg-color) !important;

    /* background: #0081a8; */
}


@media only screen and (max-width: 414px) {

    #wrapper #dialog #form input {

        font-size: 34px;
        width: 10%;

    }
}

        </style>
    @else

        <style>
            .mainDiv.my-scrollbar {
                padding-top: 200px;
                min-height: 100vh;
            }

            .mainDiv.my-scrollbar .main {
                background: #fff !important;
                height: 100%;
            }


            /* verification input */
            #wrapper {
                font-family: Lato;
                font-size: 1.5rem;
                text-align: center;
                box-sizing: border-box;
                color: #333;
            }

            #wrapper #dialog h3 {
                margin: 0 0 10px;
                padding: 0;
                line-height: 1.25;
            }

            #wrapper #dialog span {
                font-size: 90%;
            }

            #wrapper #dialog #form {
                width: 100%;
            }

            #wrapper #dialog #form input {
                margin: 0;
                text-align: center;
                font-size: 44px;
                border: none;
                outline: none;
                width: 9%;
                border-radius: 50%;
                font-weight: 700;
                font-family: 'gilroyblack';
                color: #0081a8;
                position: relative;
            }

            #wrapper #dialog #form input::after {
                content: '-';
                position: absolute;
                top: 0;
                left: 0;
            }

            #wrapper #dialog #form input::selection {
                background: transparent;
            }

            #wrapper #dialog button.close {
                border: solid 2px;
                border-radius: 30px;
                line-height: 19px;
                font-size: 120%;
                width: 22px;
                position: absolute;
                right: 5px;
                top: 5px;
            }

            /* #wrapper #dialog div {
            position: relative;
            z-index: 1;
            width: 450px;

        } */
            #wrapper #dialog div input {
                background: #efeff3;
            }

            .ver-code-inp {
                background: #fff;
                border-radius: 5px;
                display: flex;
                justify-content: space-between;
                align-items: center;

            }

            .withFith {
                display: flex;
                justify-content: center;
                text-align: center;
                align-items: center;
            }

            .lims_heading {
                font-size: 3rem;
                text-align: center;
                color: #0081a8;
                font-weight: 700;
                margin-top: 1.4rem;
            }

            .signupbotton {
                padding: 6px 45px;
                background: #0081a8;
                font-family: gilroyblack;
                color: #FFF;
                border: none;
                font-weight: 700;
                border-radius: 50px;
                font-size: 24px;
            }

            .alert_message {
                margin: 10px !important;
            }

            .for-color-back {

                background: #0081a8;
            }

            @media only screen and (max-width: 414px) {

                #wrapper #dialog #form input {

                    font-size: 34px;
                    width: 10%;

                }
            }

        </style>
    @endif

</head>

<body>
    <div class="mainDiv my-scrollbar for-color-back" data-scrollbar>

        <div class="main">

            <div class="">
                <div class=" login-pg flex-column cstm-fix-height h100v">

                    <div class="container">
                        <div class="alert_message">
                            @if (Session::get('vendor_invalid_verification_code'))
                                <?php
                                session()->forget('vendor_invalid_verification_code');
                                ?>
                                <div class="alert my-2 alert-danger text-center">
                                    <p>{{ 'Invalid Verification Code' }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="withFith">

                            <div class="row">

                                <div class="col-lg-12">
                                    <h1 class="lims_heading">LIMS</h1>
                                    <div class=" mg-tem mt3">
                                        <h1>
                                            Confirmation <span> code </span>
                                            has been sent to <br> your email
                                        </h1>
                                        <p class="para">To make sure this is you, We will send you a 6-digit
                                            verification code.</p>
                                    </div>
                                    <div id="wrapper">
                                        <div id="dialog">
                                            <div id="form">
                                                <form method="POST"
                                                    action="{{ route('vendor_verification_code_submit') }}">
                                                    @csrf
                                                    <div class="gf">
                                                        <div class="ver-code-inp">
                                                            <input type="text" maxLength="1" name="num1" size="1"
                                                                min="0" max="9" pattern="[0-9]{1}" />
                                                            -
                                                            <input type="text" maxLength="1" name="num2" size="1"
                                                                min="0" max="9" pattern="[0-9]{1}" />
                                                            -
                                                            <input type="text" maxLength="1" name="num3" size="1"
                                                                min="0" max="9" pattern="[0-9]{1}" />
                                                            -
                                                            <input type="text" maxLength="1" name="num4" size="1"
                                                                min="0" max="9" pattern="[0-9]{1}" />
                                                            -
                                                            <input type="text" maxLength="1" name="num5" size="1"
                                                                min="0" max="9" pattern="[0-9]{1}" />
                                                            -
                                                            <input type="text" maxLength="1" name="num6" size="1"
                                                                min="0" max="9" pattern="[0-9]{1}" />
                                                        </div>
                                                    </div>
                                                    <form>
                                                        <div class="mb-3 mt-3">
                                                            <button class="signupbotton" type="submit">Verify</button>
                                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(function() {
        'use strict';
        var body = $('body');

        function goToNextInput(e) {
            var key = e.which,
                t = $(e.target),
                sib = t.next('input');

            if (key != 9 && (key < 48 || key > 57)) {
                e.preventDefault();
                return false;
            }

            if (key === 9) {
                return true;
            }

            if (!sib || !sib.length) {
                sib = body.find('input').eq(0);
            }
            sib.select().focus();
        }

        function onKeyDown(e) {
            var key = e.which;
            if (key === 9 || (key >= 48 && key <= 57) || key === 8) {
                return true;
            }
            e.preventDefault();
            return false;
        }

        function onFocus(e) {
            $(e.target).select();
        }

        function deleteInp(e) {
            if (e.which === 8 && (e.target.value == null || e.target.value == '')) {
                var sib = $(e.target).prev('input');
                if (!sib || !sib.length) {
                    sib = body.find('input').eq(0);
                }
                sib.select().focus();
            }
        }

        body.on('keyup', 'input', goToNextInput);
        body.on('keydown', 'input', onKeyDown);
        body.on('keydown', 'input', deleteInp);
        body.on('click', 'input', onFocus);

    })
    $('.ver-code-inp input').change((e) => {

    })
</script>
