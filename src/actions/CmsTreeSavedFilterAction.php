<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 13.09.2016
 */

namespace skeeks\cms\savedFilters\actions;

use skeeks\cms\backend\actions\BackendModelAction;
use skeeks\cms\backend\actions\BackendModelUpdateAction;
use skeeks\cms\models\CmsTree;
use skeeks\cms\models\Tree;
use skeeks\sx\helpers\ResponseHelper;
use yii\base\DynamicModel;

class CmsTreeSavedFilterAction extends BackendModelUpdateAction
{
    public $viewFile = '@skeeks/cms/savedFilters/actions/views/cms-tree';
    public $priority = 500;

    public function init()
    {
        if (!$this->_name) {
            $this->_name = \Yii::t('skeeks/savedFilters', 'Сохраненный фильтр');
        }

        if (!$this->_icon) {
            $this->_icon = 'fa fa-filter';
        }

        parent::init();
    }

    public $dynamicModel = '';

    public function run()
    {
        $model = $this->controller->model;
        $dynamicModel = new DynamicModel();
        $dynamicModel->defineAttribute('saved_filter_id', 'integer');
        $rr = new ResponseHelper();

        if (\Yii::$app->request->isAjax && !\Yii::$app->request->isPjax) {
            return $rr->ajaxValidateForm($dynamicModel);
        }

        if ($post = \Yii::$app->request->post()) {
            $dynamicModel->load(\Yii::$app->request->post());
        }

        if ($rr->getIsRequestPjaxPost()) {
            if (!\Yii::$app->request->post($this->reloadFormParam)) {
                if ($dynamicModel->load(\Yii::$app->request->post()) && $dynamicModel->save($this->modelValidate)) {
                    \Yii::$app->getSession()->setFlash('success', \Yii::t('skeeks/cms', 'Saved'));

                    if (\Yii::$app->request->post('submit-btn') == 'apply') {

                    } else {
                        return $this->controller->redirect(
                            $this->controller->url
                        );
                    }

                    $dynamicModel->refresh();
                } else {
                }
            }
        }

        $this->dynamicModel = $dynamicModel;

        return $this->render($this->viewFile);
    }



    protected function _isAllow()
    {
        $model = $this->controller->model;
        if (!$model instanceof Tree) {
            return false;
        }
        return parent::_isAllow();
    }
}