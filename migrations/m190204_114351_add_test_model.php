<?php

use yii\db\Migration;

/**
 * Class m190204_114351_add_test_model
 */
class m190204_114351_add_test_model extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey()->unsigned(),
            'title' => $this->string(255)->notNull(),
            'text' => $this->text()->notNull(),
            'lead_image_id' => $this->integer()->unsigned()->null(),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $this->createIndex('idx_post_lead_image_id', 'post', ['lead_image_id']);

        $this->addForeignKey(
            'fk_post_lead_image_id', 'post', ['lead_image_id'], 'crud_media', ['id']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_post_lead_image_id', 'post');
        $this->dropTable('post');
    }
}
