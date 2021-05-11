<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('앱이름');
            $table->string('code')->nullable()->comment('앱코드');
            $table->string('description')->nullable()->comment('앱설명');
            $table->string('company_name')->nullable()->comment('법인명');
            $table->string('businessRegistrationNumber',20)->nullable()->comment('사업자번호');
            $table->string('corporateRegistrationNumber')->nullable()->comment('법인등록번호');
            $table->string('business')->nullable()->comment('업태');
            $table->string('event')->nullable()->comment('종목');
            $table->string('representative')->nullable()->comment('대표자');
            $table->string('email')->nullable()->comment('이메일주소');
            $table->string('website')->nullable()->comment('홈페이지주소');
            $table->string('ProductName')->nullable()->comment('생산제품명');
            $table->string('postalCode1')->nullable()->comment('우편번호1');
            $table->string('postalCode2')->nullable()->comment('우편번호2');
            $table->string('address')->nullable()->comment('주소');
            $table->string('phone')->nullable()->comment('전화번호');
            $table->string('fax')->nullable()->comment('팩스번호');
            $table->string('rep_phone')->nullable()->comment('대표자 휴대폰');
            $table->string('bankAccountNumber')->nullable()->comment('계좌번호');
            $table->string('bank')->nullable()->comment('은행명');
            $table->string('remark')->nullable()->comment('비고');
            $table->integer('creator_id')->nullable()->comment('최초등록자 user id');
            $table->integer('updater_id')->nullable()->comment('최종수정자 user id');
            $table->softDeletes();
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
        Schema::dropIfExists('apps');
    }
}
