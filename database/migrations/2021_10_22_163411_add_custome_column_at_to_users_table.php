<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomeColumnAtToUsersTable extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('phone_verified_at')->nullable();
            $table->tinyInteger('is_active')->nullable();
            $table->tinyInteger('is_admin')->nullable();
            $table->string('phone')->nullable();
            $table->enum('gender',['mail,femail'])->nullable();
            $table->enum('user_type',config("app.user_types"))->nullable();
            $table->date('dop')->nullable();
            $table->tinyInteger('sms_notification')->nullable();
            $table->string('lang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone_verified_at');
            $table->dropColumn('is_active');
            $table->dropColumn('is_admin');
            $table->dropColumn('phone_number');
            $table->dropColumn('gender');
            $table->dropColumn('dop');
            $table->dropColumn('sms_notification');
            $table->dropColumn('lang');
        });
    }
}
