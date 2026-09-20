<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            if (! Schema::hasColumn('contacts', 'ip')) {
                $table->string('ip', 45)->nullable()->after('follow_at')->comment('Submitter IP');
            }
            if (! Schema::hasColumn('contacts', 'ip_location')) {
                $table->string('ip_location', 200)->nullable()->after('ip')->comment('IP Location');
            }
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['ip', 'ip_location']);
        });
    }
};
