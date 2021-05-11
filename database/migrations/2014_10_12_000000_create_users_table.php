<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('이름');
            $table->string('email')->nullable()->comment('이메일');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('code')->nullable()->unique()->comment('로그인 계정 = 사원코드');
            $table->string('password');
            $table->integer('company_id')->nullable()->comment('회사 id');
            $table->integer('department_id')->nullable()->comment('부서 id');
            $table->integer('place_id')->nullable()->comment('사업장 id');
            $table->string('position_id')->nullable()->comment('직책 id');
            $table->string('rank_id')->nullable()->comment('직급 id');
            $table->string('nationality')->nullable()->comment('국적');
            $table->string('postalCode1')->nullable()->comment('우편번호1');
            $table->string('postalCode2')->nullable()->comment('우편번호2');
            $table->string('address')->nullable()->comment('주소');
            $table->string('phoneNumber')->nullable()->comment('전화번호');
            $table->string('cellPhoneNumber')->nullable()->comment('휴대폰번호');
            $table->string('bankAccountNumber')->nullable()->comment('계좌번호');
            $table->string('bank')->nullable()->comment('은행명');
            $table->string('englishName')->nullable()->comment('영문이름');
            $table->string('chineseName')->nullable()->comment('한자이름');
            $table->string('residentRegistrationNumber')->nullable()->comment('주민번호');
            $table->tinyInteger('gender')->default(1)->comment('성별 1:남자 2:여자');
            $table->string('foreignRegistrationNumber')->nullable()->comment('외국인등록번호');
            $table->date('hireDate')->nullable()->comment('입사일');
            $table->date('retirementDate')->nullable()->comment('퇴사일');
            $table->string('remark')->nullable()->comment('비고');
            $table->integer('creator_id')->nullable()->comment('최초등록자 user id ');
            $table->integer('updater_id')->nullable()->comment('최종수정자 user id');
            $table->string('session_id')->nullable()->comment('중복로그인 방지용 session id');
            $table->softDeletes();
            $table->rememberToken();
            $table->dateTime('last_login_date')->nullable()->comment('마지막 로그인 일자');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
