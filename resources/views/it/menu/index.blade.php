@extends('layouts.master')

@push('style')
    <link href="{{asset('/css/jstree/style.min.css')}}" rel="stylesheet"/>
    <style>
        #menu_tree_div {
            border: 5px solid grey;
            border-radius: 5px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            {{--                <div class="float-left"><h3>메뉴</h3></div>--}}
            <div class="row">
                @if(count($menus))
                    <div id="menu_tree_div" class="col-md-4 p-3">
                        <ul>
                            @forelse ($menus as $menu)
                                <li data-id="{{$menu->id}}" data-sort="{{$menu->sort}}">
                                    {{ $menu->name }}
                                    @if(count($menu->childs))
                                        @include('it.menu.manageChild',['childs' => $menu->childs])
                                    @endif
                                </li>
                            @empty
                                <button class="btn btn-success" onclick="menu_create(0)">create</button>
                            @endforelse
                        </ul>
                    </div>
                @else
                    <div class="col-md-4 p-3">
                        <button class="btn btn-success" onclick="menu_create(0)">create</button>
                    </div>
                @endif

                <div id="menu_form_div" class="col-md-8">
{{--                    @include('admin.menu.create')--}}
{{--                    @include('admin.menu.edit')--}}
                </div>
                <div id="log1" class="col-12"></div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('/js/jstree.min.js')}}"></script>
    <script type="text/javascript">
        var config = {
            route:{
                create : '{{route('menus.create')}}',
                edit : '{{route('menus.edit',':id')}}',
                update:'{{route('menus.update',':id')}}',
                copy:'{{route('menus.copy',':id')}}',
                dnd : '{{route('menus.dnd',':id')}}',
                delete:'{{route('menus.delete',':id')}}'
            }
        }

        function menu_create(parent_id){
            $.ajax({
                url: config.route.create,
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    parent_id:parent_id
                } ,
                type: 'get',
                beforeSend: function () {
                    $('#loading_indicator').css('display','flex');
                }
            }).done(function (response) {
                $('#menu_form_div').html(response);
            }).fail(function (response) {
                swal.fire('오류가 발생하였습니다!');
                console.log(response);
            }).always(function () {
                $('#loading_indicator').css('display','none');
            });
        }
        function menu_edit(menu_id){
            url = config.route.edit.replace(':id',menu_id);
            $.ajax({
                url: url,
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'get',
                beforeSend: function () {
                    $('#loading_indicator').css('display','flex');
                }
            }).done(function (response) {
                $('#menu_form_div').html(response);
            }).fail(function (response) {
                swal.fire('오류가 발생하였습니다!');
                console.log(response);
            }).always(function () {
                $('#loading_indicator').css('display','none');
            });
        }

        $(function () {
            $('#menu_tree_div').jstree({
                "plugins": ["dnd", "contextmenu", 'changed'],
                "core": {
                    'check_callback':true
                },
                "max_depth":2,
                "contextmenu": {
                    items: function ($node) {
                        var tree = $('#menu_tree_div').jstree(true);
                        return {
                            "create": {
                                "separator_before": false,
                                "separator_after": true,
                                "label": "추가",
                                "action": function(obj){
                                    menu_create($node.data.id);
                                },
                            },
                            "delete":{
                                "separator_before": false,
                                "separator_after": false,
                                "label": "삭제",
                                "action": function(obj){
                                    if(confirm('하위메뉴들도 삭제됩니다.')){
                                        url = config.route.delete.replace(':id',$node.data.id);
                                        $.ajax({
                                            url: url,
                                            headers: {
                                                'Accept': 'application/json',
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            type: 'delete',
                                            beforeSend: function () {
                                                $('#loading_indicator').css('display','flex');
                                            }
                                        }).done(function (response) {
                                            window.location.reload();
                                        }).fail(function (response) {
                                            swal.fire('오류가 발생하였습니다!');
                                            console.log(response);
                                        }).always(function () {
                                            $('#loading_indicator').css('display','none');
                                        });
                                    }
                                },
                            },

                            "ccp" : {
                                "separator_before"    : true,
                                "icon"                : false,
                                "separator_after"    : false,
                                "label"                : "편집",
                                "action"            : false,
                                "submenu" : {
                                    "cut" : {
                                        "separator_before"    : false,
                                        "separator_after"    : false,
                                        "label"                : "잘라내기",
                                        "_disabled"            : function (data) {
                                            var inst = $.jstree.reference(data.reference),
                                                obj = inst.get_node(data.reference);
                                            return obj.parent=='#';
                                        },
                                        "action"            : function (data) {
                                            var inst = $.jstree.reference(data.reference),
                                                obj = inst.get_node(data.reference);
                                            if(inst.is_selected(obj)) {
                                                inst.cut(inst.get_top_selected());
                                            }
                                            else {
                                                inst.cut(obj);
                                            }
                                        }
                                    },
                                    "copy" : {
                                        "separator_before"    : false,
                                        "icon"                : false,
                                        "separator_after"    : false,
                                        "label"                : "복사",
                                        "_disabled"            : function (data) {
                                            var inst = $.jstree.reference(data.reference),
                                                obj = inst.get_node(data.reference);
                                            return obj.parent=='#';
                                        },
                                        "action"            : function (data) {
                                            var inst = $.jstree.reference(data.reference),
                                                obj = inst.get_node(data.reference);
                                            if(inst.is_selected(obj)) {
                                                inst.copy(inst.get_top_selected());
                                            }
                                            else {
                                                inst.copy(obj);
                                            }
                                        }
                                    },
                                    "paste" : {
                                        "separator_before"    : false,
                                        "icon"                : false,
                                        "_disabled"            : function (data) {
                                            return !$.jstree.reference(data.reference).can_paste();
                                        },
                                        "separator_after"    : false,
                                        "label"                : "붙여넣기",
                                        "action"            : function (data) {

                                            var inst = $.jstree.reference(data.reference),
                                                obj = inst.get_node(data.reference);
                                                buffer_node = inst.get_buffer();
                                            inst.paste(obj);

                                            if(obj.data !== undefined){
                                                parent_id = obj.data.id;
                                            }else{
                                                parent_id = 0;
                                            }

                                            menu_id = buffer_node.node[0].data.id;

                                            if(buffer_node.mode == 'move_node'){
                                                url = config.route.update.replace(':id',menu_id);
                                                type = 'put'
                                            }else{
                                                url = config.route.copy.replace(':id',menu_id);
                                                type = 'post'
                                            }

                                            $.ajax({
                                                url: url,
                                                headers: {
                                                    'Accept': 'application/json',
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                data: {
                                                    parent_id:parent_id
                                                },
                                                type: type,
                                                beforeSend: function () {
                                                    $('#loading_indicator').css('display','flex');
                                                }
                                            }).done(function(response){
                                                window.location.reload();
                                            }).fail(function (response) {
                                                swal.fire('오류가 발생하였습니다!');
                                                console.log(response);
                                            }).always(function () {
                                                $('#loading_indicator').css('display','none');
                                            });

                                            $.vakata.context.hide();
                                            //todo 같은 노드에 paste 일시
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            });

            $("#menu_tree_div").jstree('open_all');

            // 좌클릭 상세정보
            $("#menu_tree_div")
                .bind("select_node.jstree", function (event, data) {
                    var evt =  window.event || event;
                    var button = evt.which || evt.button;
                    if( button != 1 && ( typeof button != "undefined")) return false;
                    console.log(data);
                    menu_edit(data.node.data.id);
                });

            function getSiblings(nodeID, parent) {
                var tree = $('#menu_tree_div').jstree(true),
                    parentNode = tree.get_node(parent),
                    aChildren = parentNode.children,
                    aSiblings = [];

                aChildren.forEach(function(c){
                    if(c !== nodeID) aSiblings.push(c);
                });
                return aSiblings;
            }

            //drag drop
            $("#menu_tree_div")
                .bind("move_node.jstree", function (event, data) {
                    var new_parent_node = $('#menu_tree_div').jstree(true).get_node(data.parent);
                    var old_parent_node = $('#menu_tree_div').jstree(true).get_node(data.old_parent);
                    var new_parent_id = (new_parent_node.data !== undefined) ? new_parent_node.data.id : 0;
                    var old_parent_id = (old_parent_node.data !== undefined) ? old_parent_node.data.id : 0;
                    var new_parent_child_ids = [];
                    var old_parent_child_ids = [];
                    new_parent_node.children.forEach(child =>
                        new_parent_child_ids.push($('#'+child).data('id'))
                    )
                    old_parent_node.children.forEach(child =>
                        old_parent_child_ids.push($('#'+child).data('id'))
                    )
                    console.log(new_parent_child_ids);
                    console.log(old_parent_child_ids);
                    // return false;
                    menu_id = data.node.data.id;
                    url = config.route.dnd.replace(':id',menu_id);
                    $.ajax({
                        url: url,
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            old_parent_id:old_parent_id,
                            old_parent_child_ids:old_parent_child_ids,
                            new_parent_id:new_parent_id,
                            new_parent_child_ids:new_parent_child_ids,
                        },
                        type: 'put',
                        beforeSend: function () {
                            $('#loading_indicator').css('display','flex');
                        }
                    }).done(function(response){
                        $('#loading_indicator').css('display','flex');
                        window.location.reload();
                    }).fail(function (response) {
                        swal.fire('오류가 발생하였습니다!');
                        console.log(response);
                    }).always(function () {
                        $('#loading_indicator').css('display','none');
                    });
                });

        });
    </script>
@endpush
