<?php
/**
 * NOTICE OF LICENSE
 *
 * UNIT3D is open-sourced software licensed under the GNU General Public License v3.0
 * The details is bundled with this project in the file LICENSE.txt.
 *
 * @project    UNIT3D
 * @license    https://choosealicense.com/licenses/gpl-3.0/  GNU General Public License v3.0
 * @author     BluCrew
 */
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 45);
			$table->string('slug', 90);
			$table->integer('position')->nullable();
			$table->string('color', 10);
			$table->string('icon', 50)->nullable();
			$table->string('effect', 50)->default('none');
			$table->boolean('is_admin');
			$table->boolean('is_modo');
			$table->boolean('is_trusted');
			$table->boolean('is_immune');
			$table->boolean('is_freeleech');
			$table->boolean('autogroup')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('groups');
	}

}
