<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 25.11.2016
 */
namespace skeeks\cms\savedFilters\controllers;

use skeeks\cms\base\Controller;
use skeeks\cms\savedFilters\models\SavedFilters;

class SavedFiltersController extends Controller
{
    /**
     * @var SavedFilters
     */
    public $_model = false;

    /**
     * @return $this|string
     * @throws NotFoundHttpException
     */
    public function actionView()
    {
        if (!$this->model)
        {
            throw new NotFoundHttpException(\Yii::t('skeeks/savedFilters', 'Page not found'));
        }

        $this->_initStandartMetaData();

        return $this->render($viewFile, [
            'model' => $this->model
        ]);

    }

    /**
     * @return null|SavedFilters
     */
    public function getModel()
    {
        if ($this->_model !== false)
        {
            return $this->_model;
        }

        if (!$id = \Yii::$app->request->get('id'))
        {
            $this->_model = null;
            return null;
        }

        $this->_model = SavedFilters::find()->where([
            'id' => $id
        ])->one();

        return $this->_model;
    }

    /**
     * @return $this
     */
    protected function _initStandartMetaData()
    {
        $model = $this->model;

        if ($title = $model->meta_title)
        {
            $this->view->title = $title;
        } else
        {
            if (isset($model->name))
            {
                $this->view->title = $model->name;
            }
        }

        if ($meta_keywords = $model->meta_keywords)
        {
            $this->view->registerMetaTag([
                "name"      => 'keywords',
                "content"   => $meta_keywords
            ], 'keywords');
        }

        if ($meta_descripption = $model->meta_description)
        {
            $this->view->registerMetaTag([
                "name"      => 'description',
                "content"   => $meta_descripption
            ], 'description');
        }
        else
        {
            if (isset($model->name))
            {
                $this->view->registerMetaTag([
                    "name"      => 'description',
                    "content"   => $model->name
                ], 'description');
            }
        }

        return $this;
    }

}