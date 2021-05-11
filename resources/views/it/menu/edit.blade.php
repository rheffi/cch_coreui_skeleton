<div class="p-3">
    <form id ='menu_form' enctype="multipart/form-data" method="POST" action="{{route('menus.update',$menu->id)}}">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="parent_id" value="{{$menu->parent_id}}">
        {{ csrf_field() }}
        <table class="table table-bordered table-striped">
            <tr>
                <th scope="col">상위메뉴</th>
                <td id="parent_menu_name">{{$menu->parent->name ?? ''}}</td>
            </tr>
            <tr>
                <th class='w-25' scope="col">메뉴명</th>
                <td class='w-75'>
                    <input class="form-control" type="text" name="name" value="{{$menu->name ?? ''}}" required>
                </td>
            </tr>
            <tr>
                <th scope="col">manifest_name</th>
                <td>
                    <input class="form-control" type="text" name="manifest_name" value="{{$menu->manifest_name ??  ''}}" required >
                </td>
            </tr>
            <tr>
                <th scope="col">href</th>
                <td>
                    <input class="form-control" type="text" name="href" value="{{$menu->href ?? ''}}" required>
                </td>
            </tr>
        </table>
        <button class="float-right btn btn-success" type="submit">수정</button>
    </form>
</div>
