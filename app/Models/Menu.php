<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'parent_id',
        'manifest_name',
        'href',
        'sort',
        'creator_id',
        'updater_id'
    ];

    public function parent(){
        return $this->belongsTo(Menu::class);
    }
    public function childs(){
        return $this->hasMany(Menu::class,'parent_id','id')->with('childs')->orderBY('sort','asc');
    }
    public function creator(){
        return $this->belongsTo(User::class,'creator_id');
    }
    public function updater(){
        return $this->belongsTo(User::class,'updater_id');
    }
}
