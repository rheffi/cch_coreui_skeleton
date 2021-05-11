<ul>
    @foreach($childs as $child)
        <li data-id="{{$child->id}}" data-sort="{{$menu->sort}}">
            {{ $child->name }}
            @if(count($child->childs))
                @include('it.menu.manageChild',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>
