<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_domains', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('domain_name');
            $table->string('password');
            $table->string('tenant_id')->nullable();
            $table->string('type');
            $table->boolean('is_approved')->default(0);
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
        Schema::dropIfExists('request_domains');
    }
}
