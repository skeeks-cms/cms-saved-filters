<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 25.11.2016
 */
namespace skeeks\cms\savedFilters;
use skeeks\cms\base\ConfigFormInterface;
use skeeks\cms\import\models\ImportTask;
use skeeks\cms\savedFilters\models\SavedFilters;
use yii\base\Component;
use yii\base\Model;
use yii\widgets\ActiveForm;

/**
 * Class SavedFiltersHandler
 *
 * @package skeeks\cms\savedFilters
 */
abstract class SavedFiltersHandler extends Model implements SavedFiltersHandlerInterface, ConfigFormInterface
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var SavedFilters
     */
    public $model;

    /**
     * @param ActiveForm $form
     */
    public function renderConfigForm(ActiveForm $form)
    {}

    /**
     * @param ActiveForm $form
     */
    public function renderWidget(ActiveForm $form)
    {
        echo 'Not found widget';
    }
}