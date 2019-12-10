<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailTableColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('details', function (Blueprint $table) {
            $table->integer('chance_of_playing_next_round')->nullable()->unsigned();
            $table->integer('chance_of_playing_this_round')->nullable()->unsigned();
            $table->decimal('cost_change_event', 8, 2)->default(0);
            $table->decimal('cost_change_event_fall', 8, 2)->default(0);
            $table->decimal('cost_change_start', 8, 2)->default(0);
            $table->decimal('dreamteam_count', 8, 2)->default(0);
            $table->decimal('ep_next', 8, 2)->default(0);
            $table->decimal('ep_this', 8, 2)->default(0);
            $table->decimal('event_points', 8, 2)->default(0);
            $table->decimal('in_dreamteam', 8, 2)->default(0);
            $table->decimal('now_cost', 8, 2)->default(0);
            $table->string('photo')->nullable();
            $table->decimal('points_per_game', 8, 2)->default(0);
            $table->decimal('selected_by_percent', 8, 2)->default(0);
            $table->string('squad_number')->nullable();
            $table->decimal('team', 8, 2)->default(0);
            $table->decimal('team_code', 8, 2)->default(0);
            $table->string('status')->nullable();
            $table->integer('transfers_in')->nullable()->unsigned();
            $table->integer('transfers_in_event')->nullable()->unsigned();
            $table->integer('transfers_out')->nullable()->unsigned();
            $table->integer('transfers_out_event')->nullable()->unsigned();
            $table->string('web_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('details', function (Blueprint $table) {
            $table->dropColumn([
                'chance_of_playing_next_round', 
                'chance_of_playing_this_round', 
                'cost_change_event',
                'cost_change_event_fall',
                'cost_change_start',
                'dreamteam_count',
                'ep_next',
                'ep_this',
                'event_points',
                'in_dreamteam',
                'now_cost',
                'photo',
                'points_per_game',
                'selected_by_percent',
                'squad_number',
                'team',
                'team_code',
                'status',
                'transfers_in',
                'transfers_in_event',
                'transfers_out',
                'transfers_out_event',
                'web_name'
            ]);
        });
    }
}
