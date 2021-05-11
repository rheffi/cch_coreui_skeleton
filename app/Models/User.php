<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'account',
        'password',
        'company_id',
        'department_id',
        'position_id',
        'rank_id',
        'nationality',
        'postalCode1',
        'postalCode2',
        'address',
        'phoneNumber',
        'cellPhoneNumber',
        'bankAccountNumber',
        'bank',
        'englishName',
        'chineseName',
        'residentRegistrationNumber',
        'gender',
        'foreignRegistrationNumber',
        'hireDate',
        'retirementDate',
        'remark',
        'creator_id',
        'updater_id',
        'last_login_date'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function rank(){
        return $this->belongsTo(Rank::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function creator(){
        return $this->belongsTo(User::class,'creator_id');
    }
    public function updater(){
        return $this->belongsTo(User::class,'updater_id');
    }
}
