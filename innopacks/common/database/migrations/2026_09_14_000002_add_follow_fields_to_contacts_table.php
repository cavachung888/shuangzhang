<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            if (! Schema::hasColumn('contacts', 'country')) {
                $table->string('country', 100)->nullable()->after('company')->comment('Country');
            }
            if (! Schema::hasColumn('contacts', 'address')) {
                $table->string('address', 255)->nullable()->after('country')->comment('Address');
            }
            if (! Schema::hasColumn('contacts', 'follow_status')) {
                $table->string('follow_status', 50)->nullable()->after('attachment')->comment('Follow Status');
            }
            if (! Schema::hasColumn('contacts', 'follow_at')) {
                $table->timestamp('follow_at')->nullable()->after('follow_status')->comment('Follow Time');
            }
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['country', 'address', 'follow_status', 'follow_at']);
        });
    }
};
