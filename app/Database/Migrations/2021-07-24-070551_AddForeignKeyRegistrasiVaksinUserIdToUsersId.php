<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddForeignKeyRegistrasiVaksinUserIdToUsersId extends Migration
{
	public function up()
	{
		$this->forge->addForeignKey('user_id', 'users', 'id');
	}

	public function down()
	{
		//
	}
}
