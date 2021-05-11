<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class App extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;

    protected $fillable = [
        'name',
        'code',
        'description',
        'company_name',
        'name',
        'businessRegistrationNumber',
        'corporateRegistrationNumber',
        'business',
        'event',
        'representative',
        'email',
        'website',
        'ProductName',
        'postalCode1',
        'postalCode2',
        'address',
        'phone',
        'fax',
        'rep_phone',
        'bankAccountNumber',
        'bank',
        'map',
        'remark',
        'creator_id',
        'updater_id',
    ];


    public function creator(){
        return $this->belongsTo(User::class,'creator_id');
    }
    public function updater(){
        return $this->belongsTo(User::class,'updater_id');
    }
}
