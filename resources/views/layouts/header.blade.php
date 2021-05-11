<header class="c-header c-header-light
{{--c-header-fixed --}}
c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar"
            data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button>
    <a class="c-header-brand d-sm-none" href="/">
        HSMT
        {{--                <img class="c-header-brand" src="/assets/brand/coreui-base.svg" width="97" height="46" alt="CoreUI Logo">--}}
    </a>
    <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar"
            data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
               aria-expanded="false">
                <span class="cil-user nav-icon cui-cursor">{{ Auth::user()->name ?? '' }} 님</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0" style="z-index: 1021">
                <div class="dropdown-header bg-light py-2">
                    <strong></strong>
                </div>
                <form action="/logout" method="POST"> @csrf
                    <div class="dropdown-item">
                        <svg class="c-icon mr-2">
                            <use xlink:href="/icons/sprites/free.svg#cil-account-logout"></use>
                        </svg>

                        <button type="submit" class="btn btn-ghost-dark btn-block">Logout</button>

                    </div>
                </form>
                <div class="dropdown-item">
                    <svg class="c-icon mr-2">
                        <use xlink:href="/icons/sprites/free.svg#cil-info"></use>
                    </svg>
                    <button type="button" class="btn btn-ghost-dark btn-block" id="login_user_info_edit_btn">정보수정</button>
                </div>
            </div>
        </li>
    </ul>
    <div class="c-subheader px-3" >
        <ol class="breadcrumb border-0 m-0 p-1">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"></li>
            <li class="breadcrumb-item active"></li>
        </ol>
    </div>
</header>
