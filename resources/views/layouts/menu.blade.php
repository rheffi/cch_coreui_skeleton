
<style>
    .c-sidebar-minimized .co_name {
        display: none;
    }
    .c-sidebar-minimized .cil-home {
        font-size:1.5rem;
    }
</style>
<div class="c-sidebar-brand">
    <a href="/">
        <button class="btn btn-ghost-light"><i class="cil-home"></i> <span class="co_name">(주){{config('app.co_name')}}</span></button>
    </a>
</div>
<ul class="c-sidebar-nav">
    @php $i=0 @endphp
    @foreach($menus as $menu)
        <li class="c-sidebar-nav-dropdown {{$menu->childs->where('manifest_name',$active_menu ?? '')->count() ? 'c-show':''}}">
            <a class="c-sidebar-nav-dropdown-toggle font-weight-bold" href="{{$menu->href}}">
                <i class="cil-folder c-sidebar-nav-icon text-white"></i>
                {{$menu->name}}
            </a>
            @if($menu->childs->count())
                <ul class="c-sidebar-nav-dropdown-items program_list">
                    @include('layouts.menu_child',['childs' => $menu->childs])
                </ul>
            @endif
        </li>
    @endforeach

    @if(!(auth()->user()))
        <li class="c-sidebar-nav-item">
            사용권한이 없습니다.<br>
            문의 :
        </li>
    @endif

</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
</div>
</div>


{{--@php--}}
{{--    $test = 'it';--}}
{{--    $user = Auth::user();--}}
{{--    $app = \App\App::where('name',config('custom.app'))--}}
{{--    ->has('modules')->first();--}}
{{--    $menus= ($app) ? $app->modules()->get():[];--}}
{{--@endphp--}}
{{--<style>--}}
{{--    .c-sidebar-minimized .co_name {--}}
{{--        display: none;--}}
{{--    }--}}
{{--    .c-sidebar-minimized .cil-home {--}}
{{--        font-size:1.5rem;--}}
{{--    }--}}
{{--</style>--}}
{{--<div class="c-sidebar-brand">--}}
{{--    <a href="/">--}}
{{--        <button class="btn btn-ghost-light"><i class="cil-home"></i> <span class="co_name">(주){{config('mes.co_name')}}</span></button>--}}
{{--    </a>--}}
{{--</div>--}}
{{--<ul class="c-sidebar-nav">--}}

{{--    @php $i=0 @endphp--}}
{{--    @foreach($menus as $menu)--}}
{{--        @if($menu->use)--}}
{{--            <li class="c-sidebar-nav-dropdown">--}}
{{--                <a class="c-sidebar-nav-dropdown-toggle font-weight-bold" href="#">--}}
{{--                    <i class="cil-folder c-sidebar-nav-icon text-white"></i>--}}
{{--                    {{$menu->name}}--}}
{{--                </a>--}}
{{--                <ul class="c-sidebar-nav-dropdown-items program_list">--}}
{{--                    @foreach($menu->programs as $program)--}}
{{--                        @if($program->use  &&  auth()->user() && auth()->user()->can($program->manifest_name.'-list'))--}}
{{--                            <li class="c-sidebar-nav-item">--}}
{{--                                <a class="c-sidebar-nav-link" href="{{$program->href}}">--}}
{{--                                    <span class="c-sidebar-nav-icon"></span>--}}
{{--                                    {{$program->name}}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            @php $i++ @endphp--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        @endif--}}
{{--    @endforeach--}}

{{--    @if(auth()->user() && $i==0 )--}}
{{--        <li class="c-sidebar-nav-item">--}}
{{--            <a class="c-sidebar-nav-dropdown-toggle" href="#"--}}
{{--               onclick="document.getElementById('sidebar_nav_logout').submit();">--}}
{{--                <svg class="c-icon mr-2">--}}
{{--                    <use xlink:href="/icons/sprites/free.svg#cil-account-logout"></use>--}}
{{--                </svg>--}}
{{--                Logout--}}
{{--            </a>--}}
{{--            <form action="/logout" method="POST" id="sidebar_nav_logout"> @csrf</form>--}}
{{--            사용권한이 없습니다.<br>--}}
{{--            문의 : 123-1234-1234--}}
{{--        </li>--}}
{{--    @elseif(!(auth()->user()))--}}
{{--        <li class="c-sidebar-nav-item">--}}
{{--            사용권한이 없습니다.<br>--}}
{{--            문의 : 123-1234-1234--}}
{{--        </li>--}}
{{--    @endif--}}

{{--</ul>--}}
{{--<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"--}}
{{--        data-class="c-sidebar-minimized"></button>--}}
{{--</div>--}}
{{--</div>--}}


