<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 30.08.2016
 */
use yii\db\Schema;
use yii\db\Migration;

class m171208_100558_alter_table__saved_filters extends Migration
{
    public function safeUp()
    {
        $this->addColumn("{{%saved_filters}}", "cms_tree_id", $this->integer());
        $this->createIndex("saved_filters__cms_tree_id_ix", "{{%saved_filters}}", "cms_tree_id");

        $this->addForeignKey(
            'saved_filters__cms_tree_id', "{{%saved_filters}}",
            'cms_tree_id', '{{%cms_tree}}', 'id', 'SET NULL', 'SET NULL'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey("saved_filters__cms_tree_id", "{{%saved_filters}}");
        $this->dropColumn("{{%saved_filters}}", "cms_tree_id");
    }
}