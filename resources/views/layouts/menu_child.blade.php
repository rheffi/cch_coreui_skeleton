
    @foreach($childs as $child)
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{($active_menu ?? 'none') == $child->manifest_name ? 'c-active':''}}" href="{{$child->href}}">
                <span class="c-sidebar-nav-icon"></span>
                {{$child->name}}
            </a>
        </li>
        @if($child->childs->count())
            @include('layouts.menu_child',['childs' => $child->childs])
        @endif
    @endforeach

