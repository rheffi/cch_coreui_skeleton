<?php

namespace App\Http\Controllers\it;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::where('parent_id', '=', 0)->with('childs')->orderBy('sort','asc')->get();

        if ($request->ajax()) {
            return view('it.menu.tree', compact('menus'))->render();
        } else {
            return view('it.menu.index', compact('menus'));
        }
    }

    public function create(Request $request)
    {
        $params = [
            'parent_id' => $request->input('parent_id')
        ];

        $parent_menu = Menu::find($params['parent_id']);

        return view('it.menu.create', compact([
            'parent_menu'
        ]))->render();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'manifest_name' => 'required',
            'href' => 'required',
        ]);
        $input = $request->all();
        $input['creator_id'] = \Auth::user()->id;
        $input['updater_id'] = \Auth::user()->id;

        Menu::create($input);

        //순서 재정렬
        $parent_menu = Menu::with('childs')->where('id',$request->input('parent_id'))->first();

        if($parent_menu){
            for($i=0;$i<count($parent_menu->childs);$i++){
                $parent_menu->childs[$i]->sort = $i;
                $parent_menu->childs[$i]->save();
            }
        }

        if (!$request->ajax()) {
            return back()->with('success', 'Menu added successfully.');
        } else {
            return response()->json([
                'result' => 'success',
            ]);
        }
    }

    public function edit(Request $request, $menu_id)
    {
        $menu = Menu::with('parent')->where('id', $menu_id)->first();
        return view('it.menu.edit', compact([
            'menu'
        ]))->render();
    }

    public function update(Request $request, $menu_id)
    {
        $input = $request->all();
        $input['updater_id'] = \Auth::user()->id;

        Menu::find($menu_id)->update($input);

        if (!$request->ajax()) {
            return redirect()->back()->with('success', 'Menu updated successfully.');
        } else {
            return response()->json([
                'result' => 'success',
            ]);
        }
    }

    //하위메뉴 복사할 메뉴, 복사된 메뉴,유저,복사된 메뉴 id
    private function recursive_clone($menu, $copy_menu, $user,$copy_id)
    {
        //$copy_id 제외 없으면 상위메뉴 하위메뉴에 복붙할시 무한반복에러
        foreach ($menu->childs->where('id','!=',$copy_id) as $child) {
            $copy_child = Menu::create([
                'name' => $child->name,
                'parent_id' => $copy_menu->id,
                'manifest_name' => $child->manifest_name,
                'href' => $child->hret,
                'sort' => $child->sort,
                'creator_id' => $user->id,
                'updater_id' => $user->id
            ]);
            $this->recursive_clone($child, $copy_child, $user,$copy_id);
        }
    }

    public function copy(Request $request, $menu_id)
    {
        $params = [
            'menu_id' => $menu_id,
            'parent_id' => $request->input('parent_id')
        ];

        $user = \Auth::user();
        $menu = Menu::with('childs')->where('id', $params['menu_id'])->first();

        $copy_menu = Menu::create([
            'name' => $menu->name,
            'parent_id' => $params['parent_id'],
            'manifest_name' => $menu->manifest_name,
            'href' => $menu->hret,
            'sort' => $menu->sort,
            'creator_id' => $user->id,
            'updater_id' => $user->id
        ]);

        $this->recursive_clone($menu, $copy_menu, $user,$copy_menu->id);

        //순서 재정렬
        $parent_menu = Menu::with('childs')->where('id',$params['parent_id'])->first();
        if($parent_menu){
            for($i=0;$i<count($parent_menu->childs);$i++){
                $parent_menu->childs[$i]->sort = $i;
                $parent_menu->childs[$i]->save();
            }
        }
    }

    public function dnd(Request $request, $menu_id)
    {
        $params = [
            'old_parent_id' => $request->input('old_parent_id'),
            'old_parent_child_ids' => $request->input('old_parent_child_ids'),
            'new_parent_id' => $request->input('new_parent_id'),
            'new_parent_child_ids' => $request->input('new_parent_child_ids'),
        ];

        $user = Auth::user();
        if($params['old_parent_id'] != $params['new_parent_id']){
            Menu::find($menu_id)->update([
                'parent_id' => $params['new_parent_id'],
                'updater_id' => $user->id
            ]);

            if($params['old_parent_child_ids']){
                $old_ids_ordered = implode(',', $params['old_parent_child_ids']);
                $old_parent_childs = Menu::whereIn('id', $params['old_parent_child_ids'])
                    ->orderByRaw("FIELD(id, $old_ids_ordered)")
                    ->get();

                $i=0;
                for($i=0; $i < $old_parent_childs->count() ; $i++){
                    $old_parent_childs[$i]->sort = $i;
                    $old_parent_childs[$i]->save();
                }
            }
        }

        if($params['new_parent_child_ids']){
            $new_ids_ordered = implode(',', $params['new_parent_child_ids']);
            $new_parent_childs = Menu::whereIn('id', $params['new_parent_child_ids'])
                ->orderByRaw("FIELD(id, $new_ids_ordered)")
                ->get();

            $i=0;
            for($i=0; $i < $new_parent_childs->count() ; $i++){
                $new_parent_childs[$i]->sort = $i;
                $new_parent_childs[$i]->save();
            }
        }
    }

    private function getChildren($menu){
        $ids = [];
        foreach ($menu->childs as $cat) {
            $ids[] = $cat->id;
            $ids = array_merge($ids, $this->getChildren($cat));
        }
        return $ids;
    }
    public function destroy(Request $request,$menu_id){
        $menu = Menu::find($menu_id);
        $parent_menu = $menu->parent;

        $array_of_ids = $this->getChildren($menu);
        array_push($array_of_ids,$menu_id);
        Menu::destroy($array_of_ids);

        //재정렬
        if($parent_menu){
            for($i=0;$i<count($parent_menu->childs);$i++){
                $parent_menu->childs[$i]->sort = $i;
                $parent_menu->childs[$i]->save();
            }
        }
    }
}
