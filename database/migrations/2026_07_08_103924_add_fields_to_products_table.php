<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->string('slug')->nullable()->after('name');

            $table->text('description')->nullable()->after('category');

            $table->integer('stock')->default(0)->after('price');

            $table->integer('reorder_level')->default(10)->after('stock');

            $table->boolean('status')->default(true)->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn([
                'slug',
                'description',
                'status'
            ]);
        });
    }
};
