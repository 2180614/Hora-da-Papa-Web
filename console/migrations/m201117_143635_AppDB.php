<?php

use yii\db\Migration;

/**
 * Class m201117_143635_AppDB
 */
class m201117_143635_AppDB extends Migration
{
    public function up()
    {
        $this->createTable('utilizador', [
            'user_id' => $this->primaryKey()->notNull(),
            'p_nome' => $this->string()->notNull(),
            'u_nome' => $this->string(),
            'tlm' => $this->string()->unique(),
        ]);
        $this->createTable('venda', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'takeaway' => $this->boolean()->notNull(),
            'mesa' => $this->integer()->notNull(),
            'preco' => $this->decimal(4, 2)->notNull(),
            'data_entrada' => $this->timestamp()->notNull(),
            'data_saida' => $this->timestamp(),
        ]);
        $this->createTable('pedido', [
            'id' => $this->primaryKey(),
            'venda_id' => $this->integer()->notNull(),
            'prato_id' => $this->integer()->notNull(),
            'quantidade' => $this->integer()->notNull(),
            'descricao' => $this->text(),
            'status' => $this->Boolean()->notNull(),
        ]);
        $this->createTable('prato', [
            'id' => $this->primaryKey(),
            'nome' => $this->string()->notNull(),
            'categoria' => "ENUM('prato', 'entrada', 'sobremesa') NOT NULL",
            'descricao' => $this->text(),
            'preco' => $this->decimal(4, 2)->notNull(),
            'imagem' => $this->string(),
        ]);

        $this->addForeignKey('FK_user_utilizador', 'utilizador', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_user_venda', 'venda', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_venda_pedido', 'pedido', 'venda_id', 'venda', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_prato_pedido', 'pedido', 'prato_id', 'prato', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('utilizador');
        $this->dropTable('pedido');
        $this->dropTable('venda');      
        $this->dropTable('prato');
    }
}
