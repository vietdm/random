<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $user = new User;
        $user->fullname = 'Admin';
        $user->username = 'admin';
        $user->email = 'admin@local.rand';
        $user->password = '$2a$12$y3JgdgW8ldum2eFolGKOJOuDIlL6kkBk7bGkKKzqP74cNefdgohhW';
        $user->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
