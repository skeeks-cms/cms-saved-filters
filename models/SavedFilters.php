<?php

namespace skeeks\cms\savedFilters\models;

use skeeks\cms\models\behaviors\HasStorageFile;
use skeeks\cms\models\behaviors\SeoPageName;
use skeeks\cms\models\behaviors\Serialize;
use skeeks\cms\models\CmsStorageFile;
use skeeks\cms\models\CmsUser;
use skeeks\cms\savedFilters\SavedFiltersHandler;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "saved_filters".
 *
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $image_id
 * @property string $name
 * @property string $code
 * @property string $description_short
 * @property string $description_full
 * @property string $description_short_type
 * @property string $description_full_type
 * @property string $component
 * @property string $component_settings
 * @property integer $priority
 * @property integer $is_active
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 *
 * @property string $url
 * @property SavedFiltersHandler $handler
 *
 * @property CmsStorageFile $image
 */
class SavedFilters extends \skeeks\cms\models\Core
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%saved_filters}}';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            Serialize::className() =>
            [
                'class' => Serialize::className(),
                'fields' => ['component_settings']
            ],

            HasStorageFile::className() =>
            [
                'class'     => HasStorageFile::className(),
                'fields'    => ['image_id']
            ],

            SeoPageName::className() =>
            [
                'class'                             => SeoPageName::className(),
                'generatedAttribute'                => 'code',
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'image_id', 'priority', 'is_active'], 'integer'],
            [['name', 'component'], 'required'],
            [['description_short', 'description_full', 'meta_description', 'meta_keywords'], 'string'],
            [['name', 'code', 'description_short_type', 'description_full_type', 'component'], 'string', 'max' => 255],
            [['meta_title'], 'string', 'max' => 500],
            [['code'], 'unique'],
            [['component_settings'], 'safe'],

            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsStorageFile::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => CmsUser::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => CmsUser::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Yii::t('skeeks/savedFilters', 'ID'),
            'created_by' => Yii::t('skeeks/savedFilters', 'Created By'),
            'updated_by' => Yii::t('skeeks/savedFilters', 'Updated By'),
            'created_at' => Yii::t('skeeks/savedFilters', 'Created At'),
            'updated_at' => Yii::t('skeeks/savedFilters', 'Updated At'),
            'image_id' => Yii::t('skeeks/savedFilters', 'Image'),
            'name' => Yii::t('skeeks/savedFilters', 'Name'),
            'code' => Yii::t('skeeks/savedFilters', 'Code'),
            'description_short' => Yii::t('skeeks/savedFilters', 'Description short'),
            'description_full' => Yii::t('skeeks/savedFilters', 'Description full'),
            'description_short_type' => Yii::t('skeeks/savedFilters', 'Description Short Type'),
            'description_full_type' => Yii::t('skeeks/savedFilters', 'Description Full Type'),
            'component' => Yii::t('skeeks/savedFilters', 'Component'),
            'component_settings' => Yii::t('skeeks/savedFilters', 'Component Settings'),
            'priority' => Yii::t('skeeks/savedFilters', 'Priority'),
            'is_active' => Yii::t('skeeks/savedFilters', 'Is Active'),
            'meta_title' => Yii::t('skeeks/savedFilters', 'Meta Title'),
            'meta_description' => Yii::t('skeeks/savedFilters', 'Meta Description'),
            'meta_keywords' => Yii::t('skeeks/savedFilters', 'Meta Keywords'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(CmsStorageFile::className(), ['id' => 'image_id']);
    }


    /**
     * @return SavedFiltersHandler
     * @throws \skeeks\cms\import\InvalidParamException
     */
    public function getHandler()
    {
        if ($this->component)
        {
            try
            {
                /**
                 * @var $component Component
                 */
                $component = \Yii::$app->savedFilters->getHandler($this->component);
                $component->model = $this;
                $component->load($this->component_settings, "");

                return $component;
            } catch (\Exception $e)
            {
                return false;
            }

        }

        return null;
    }


    /**
     * @return string
     */
    public function getUrl($scheme = false)
    {
        return Url::to(['/savedFilters/saved-filters/view', 'id' => $this->id], $scheme);
    }


}