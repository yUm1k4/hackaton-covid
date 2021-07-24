<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RegistrasiVaksin extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_reg_vaksin' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'user_id'		=> [
				'type'			=> 'int',
				'constraint'	=> 11,
				'unsigned'		=> true
			],
			'nik' => [
				'type' => 'VARCHAR',
				'constraint' => 16,
			],
			'no_hp'			=> ['type' => 'varchar', 'constraint' => 13],
			'alamat'           => ['type' => 'varchar', 'constraint' => 255],
			'status'		=> [
				'type'			=> 'enum',
				'constraint'	=> ['pending', 'proses', 'selesai'],
				'default'        => 'pending',
			],
			'hasil_akhir'	=> [
				'type'			=> 'text',
				'null'			=> true,
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

		$this->forge->addKey('id_reg_vaksin', TRUE);
		$this->forge->addForeignKey('user_id', 'users', 'id');
		$this->forge->createTable('registrasi_vaksin');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('registrasi_vaksin');
		//
	}
}
