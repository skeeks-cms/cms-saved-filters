<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 30.08.2016
 */
use yii\db\Schema;
use yii\db\Migration;

class m161125_100558_create_table__saved_filters extends Migration
{
    public function safeUp()
    {
        $tableExist = $this->db->getTableSchema("{{%saved_filters}}", true);
        if ($tableExist)
        {
            return true;
        }

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable("{{%saved_filters}}", [
            'id'                    => $this->primaryKey(),

            'created_by'            => $this->integer(),
            'updated_by'            => $this->integer(),

            'created_at'            => $this->integer(),
            'updated_at'            => $this->integer(),

            'image_id'              => $this->integer(),
            'name'                  => $this->string(255)->notNull()->comment('Name'),
            'code'                  => $this->string(255)->notNull()->unique()->comment('Code'),
            'description_short'     => $this->text()->comment('Description short'),
            'description_full'      => $this->text()->comment('Description full'),

            'description_short_type'=> $this->string()->defaultValue('text'),
            'description_full_type' => $this->string()->defaultValue('text'),

            'component'             => $this->string(255)->notNull(),
            'component_settings'    => $this->text(),

            'priority'              => $this->integer()->notNull()->defaultValue(100),
            'is_active'             => $this->integer(1)->notNull()->defaultValue(1),

            'meta_title'            => $this->string(500),
            'meta_description'      => $this->text(),
            'meta_keywords'         => $this->text(),

        ], $tableOptions);

        $this->createIndex('saved_filters__updated_by_ix', '{{%saved_filters}}', 'updated_by');
        $this->createIndex('saved_filters__created_by_ix', '{{%saved_filters}}', 'created_by');
        $this->createIndex('saved_filters__created_at_ix', '{{%saved_filters}}', 'created_at');
        $this->createIndex('saved_filters__updated_at_ix', '{{%saved_filters}}', 'updated_at');

        $this->createIndex('saved_filters__name', '{{%saved_filters}}', 'name');
        $this->createIndex('saved_filters__image_id', '{{%saved_filters}}', 'image_id');

        $this->addForeignKey(
            'saved_filters__created_by', "{{%saved_filters}}",
            'created_by', '{{%cms_user}}', 'id', 'SET NULL', 'SET NULL'
        );

        $this->addForeignKey(
            'saved_filters__updated_by', "{{%saved_filters}}",
            'updated_by', '{{%cms_user}}', 'id', 'SET NULL', 'SET NULL'
        );

        $this->addForeignKey(
            'saved_filters__image_id', "{{%saved_filters}}",
            'image_id', '{{%cms_storage_file}}', 'id', 'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey("saved_filters__created_by", "{{%saved_filters}}");
        $this->dropForeignKey("saved_filters__updated_by", "{{%saved_filters}}");
        $this->dropForeignKey("saved_filters__image_id", "{{%saved_filters}}");

        $this->dropTable("{{%saved_filters}}");
    }
}