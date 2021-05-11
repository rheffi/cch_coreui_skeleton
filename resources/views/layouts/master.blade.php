<!doctype html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v3.0.0-alpha.1
* @link https://coreui.io
* Copyright (c) 2019 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="kr" xmlns="http://www.w3.org/1999/html">
<head>
    <base href="./">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <meta name="description" content="HSMT">
    <meta name="author" content="HSMT">
    <meta name="keyword" content="">
    <meta name="theme-color" content="#ffffff">
    <title>HSMT</title>

    <!-- Icons-->
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flag.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert2.css') }}" rel="stylesheet">

    <!-- Main styles for this application-->
    <link href="{{ asset('css/style.css') }}?version={{ now()->format('YmdH') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}?version={{ now()->format('YmdH') }}" rel="stylesheet">
    <link href="{{ asset('css/scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    @stack('style')
</head>


<body class="c-app">

<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    @include('layouts.menu')
    <div class="c-wrapper">
        @if(\Request::route()->getName() == 'pro_status.index')

        @else
            @include('layouts.header')
        @endif
        <div class="c-body">
            <main class="c-main p-0">
                @yield('content')
                <div id='login_user_info_wrapper'>
                    {{--                    @include('auth.user_info_form')--}}
                </div>
            </main>
        </div>
    </div>
</div>
<div id="loading_indicator">
    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>
</body>
<!-- CoreUI and necessary plugins-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>window.jQuery || document.write('<script src="/js/jquery.js"><\/script>')</script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
<script src="{{ asset('js/coreui-utils.js') }}"></script>
<script src="{{ asset('js/popper.js') }}"></script>
<script src="{{ asset('js/custom.js?ver=20210120') }}"></script>
<script src="{{ asset('js/sweetalert.js') }}"></script>
@stack('script')

@if ($errors->any())
    <script>
        swal.fire({
            text: "{{ implode('\n',$errors->all()) }}",
            icon: "error"
        });
    </script>
@endif

@if (\Session::has('alert') && gettype(\Session::get('alert')) !='array')

    <script>
        swal.fire({
            text: "{!! \Session::get('alert') !!}",
            icon: "{!! \Session::get('alert_state') !!}",
        });
    </script>
@endif
{{--{{dd(Session::has('alert'))}}--}}
<script>

    // Swal.fire({
    //     text : '다운로드 하시겠습니까?',
    //     type : "warning",
    //     showCancelButton : true,
    //     confirmButtonClass : "btn-danger",
    //     confirmButtonText : "예",
    //     cancelButtonText : "아니오",
    //     closeOnConfirm : false,
    //     closeOnCancel : true
    // });
    {{--$('#login_user_info_edit_btn').click(function(){--}}
    {{--    var url = '{{route('login_user.edit',':id')}}';--}}
    {{--    var user_id = '{{Auth::user()->id ?? 0}}';--}}
    {{--        url = url.replace(':id',user_id);--}}
    {{--    $.ajax({--}}
    {{--        url: url,--}}
    {{--        headers: {--}}
    {{--            'Accept': 'application/json',--}}
    {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--        },--}}
    {{--        type: 'get',--}}
    {{--        beforeSend: function () {--}}
    {{--            $('body').append('<div class="php-loading-indicator-overlay custom_loading_indicator"> <div class="cp-spinner cp-round"></div></div>');--}}
    {{--        }--}}
    {{--    }).done(function (html) {--}}
    {{--        $('#login_user_info_wrapper').html(html);--}}
    {{--        $('#user_data-Modal').modal('show');--}}
    {{--    }).fail(function (response) {--}}
    {{--        swal.fire('오류가 발생하였습니다!');--}}
    {{--        console.log(response);--}}
    {{--    }).always(function () {--}}
    {{--        $('.custom_loading_indicator').remove();--}}
    {{--    });--}}
    {{--});--}}

    //비밀번호 검사
    $(document).on('change keyup', '#user_data-Modal input[name="password"]', function () {
        var input_password = $(this).val();
        var patterns = [/(?=.*\d{1,50})(?=.*[~`!@#$%\^&*()-+=]{1,50})(?=.*[a-zA-Z]{1,50}).{8,50}$/,
            /(?=.*\d{1,50})(?=.*[a-zA-Z]{1,50}).{10,}$/,
            /(?=.*[~`!@#$%\^&*()-+=]{1,50})(?=.*[a-zA-Z]{1,50}).{10,50}$/,
            /(?=.*\d{1,50})(?=.*[~`!@#$%\^&*()-+=]{1,50}).{10,50}$/];
        var result = false;
        $.each(patterns, function (index, pattern) {
            result = pattern.test(input_password);
            if (result) return false;
        });

        if (result) {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        } else {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
        }
        $('#password-confirm').val('');
    })

    $(document).on('change keyup', '#password-confirm', function () {
        if ($(this).val() == $('#user_data-Modal input[name="password"]').val()) {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        } else {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
        }
    });

    $(document).on('submit', '#user_data', function () {
        var check = $(this).find('.is-invalid');
        if (check.length > 0) {
            check.focus();
            return false;
        }
        return true;
    })

    var CurrentScroll = 0;

    // header_bg();

    // $(document).on('scroll', function (e) {
    //     e.preventDefault();
    //     header_bg();
    // });

    // function header_bg() {
    //     var NextScroll = $(this).scrollTop();
    //     if ($(window).scrollTop() > 0) {
    //         if (NextScroll > CurrentScroll) {
    //             $('header').css({
    //                 'transform': 'translateY(-100%)'
    //             });
    //         } else {
    //             $('header').css({
    //                 'transform': 'translateY(0)'
    //             });
    //         }
    //     }
    //     CurrentScroll = NextScroll;
    // }

    $(document).on('keyup', '.businessRegistrationNumber', function () {
        var num = this.value;
        num.trim();
        this.value = CompanyNumAutoHypen(num);
    });

    function CompanyNumAutoHypen(companyNum) {
        companyNum = companyNum.replace(/[^0-9]/g, '');
        var tempNum = '';
        if (companyNum.length < 4) {
            return companyNum;
        } else if (companyNum.length < 6) {
            tempNum += companyNum.substr(0, 3);
            tempNum += '-';
            tempNum += companyNum.substr(3, 2);
            return tempNum;
        } else if (companyNum.length < 11) {
            tempNum += companyNum.substr(0, 3);
            tempNum += '-';
            tempNum += companyNum.substr(3, 2);
            tempNum += '-';
            tempNum += companyNum.substr(5);
            return tempNum;
        } else {
            tempNum += companyNum.substr(0, 3);
            tempNum += '-';
            tempNum += companyNum.substr(3, 2);
            tempNum += '-';
            tempNum += companyNum.substr(5, 5);
            return tempNum;
        }
    }


    function commas(t) {
        // 콤마 빼고
        var x = t.value;
        x = x.replace(/,/gi, '');
        // 숫자 정규식 확인
        var regexp = /^[0-9]*$/;
        if (!regexp.test(x)) {
            $(t).val("");
            swal.fire("숫자만 입력 가능합니다.");
        } else {
            x = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $(t).val(x);
        }
    }

    $(document).on('keyup', 'input[data-type="currency"]', function () {
        commas(this)
    });

</script>
</body>
</html>
