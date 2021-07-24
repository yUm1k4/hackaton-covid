<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RsRujukan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_rs_rujukan' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'nama' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'alamat' => [
				'type' => 'TEXT'
			],
			'hotline' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'created_at'       => [
				'type' => 'datetime', 'null' => true
			],
			'updated_at'       => [
				'type' => 'datetime', 'null' => true
			],
			'deleted_at'       => [
				'type' => 'datetime', 'null' => true
			],
		]);

		$this->forge->addKey('id_rs_rujukan', TRUE);
		$this->forge->createTable('rs_rujukan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('rs_rujukan');
		//
	}
}
