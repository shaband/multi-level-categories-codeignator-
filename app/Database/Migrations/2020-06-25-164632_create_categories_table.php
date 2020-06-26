<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoriesTable extends Migration
{

	public $table='categories';
		public function up()
		{
										$this->forge->addField([
																		'id'          => [
																										'type'           => 'INT',
																										'constraint'     => 12,
																										'unsigned'       => TRUE,
																										'auto_increment' => TRUE
																		],
																		'title'       => [
																										'type'           => 'VARCHAR',
																										'constraint'     => '200',
																		],
																		'category_id' => [
																			'type'           => 'INT',
																			'constraint'     => 12,
																			'unsigned'       => TRUE,
																								],
																								'created_at datetime default current_timestamp',
																								'updated_at datetime default current_timestamp on update current_timestamp',
										]);
										$this->forge->addKey('id', TRUE);
										$this->forge->createTable($this->table);

										$this->db->query($this->add_foreign_key($this->table, 'category_id', 'categories(id)', 'CASCADE', 'CASCADE')); 

		}

		public function down()
		{
										$this->forge->dropTable('categories');
		}

		function add_foreign_key($table, $foreign_key, $references, $on_delete = 'RESTRICT', $on_update = 'RESTRICT')
	{
		$references = explode('(', str_replace(')', '', str_replace('`', '', $references)));

		return "ALTER TABLE `{$table}` ADD CONSTRAINT `{$table}_{$foreign_key}_fk` FOREIGN KEY (`{$foreign_key}`) REFERENCES `{$references[0]}`(`{$references[1]}`) ON DELETE {$on_delete} ON UPDATE {$on_update}";
	}
}
