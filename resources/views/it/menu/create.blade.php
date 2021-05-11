<div class="p-3">
    <form id ='menu_form' enctype="multipart/form-data" method="POST" action="{{route('menus.store')}}">
        <input type="hidden" name="parent_id" value="{{$parent_menu->id ?? 0}}">
        {{ csrf_field() }}
        <table class="table table-bordered table-striped">
            <tr>
                <th scope="col">상위메뉴</th>
                <td id="parent_menu_name">{{$parent_menu->name ?? ''}}</td>
            </tr>
            <tr>
                <th class='w-25' scope="col">메뉴명</th>
                <td class='w-75'>
                    <input class="form-control" type="text" name="name" required>
                </td>
            </tr>
            <tr>
                <th scope="col">manifest_name</th>
                <td>
                    <input class="form-control" type="text" name="manifest_name" required>
                </td>
            </tr>
            <tr>
                <th scope="col">href</th>
                <td>
                    <input class="form-control" type="text" name="href" required>
                </td>
            </tr>
        </table>
        <button class="float-right btn btn-success" type="submit">등록</button>
    </form>
</div>
