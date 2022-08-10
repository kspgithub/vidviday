<?php

use App\Models\Page;
use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_role', function (Blueprint $table) {
            $table->foreignIdFor(Page::class)->constrained('pages')->cascadeOnDelete();
            $table->foreignIdFor(Role::class)->constrained('roles')->cascadeOnDelete();
            $table->primary(['page_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_role');
    }
}
