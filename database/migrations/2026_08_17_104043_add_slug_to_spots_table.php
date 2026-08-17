<?php

declare(strict_types=1);

use App\Models\Spot;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('spots', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
        });

        Spot::all()->each(function (Spot $spot) {
            $spot->generateSlug();
            $spot->save();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spots', function (Blueprint $table) {
            $table->dropUnique('spots_slug_unique');
            $table->dropColumn('slug');
        });
    }
};
