<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 24.05.2015
 */
namespace skeeks\cms\savedFilters;
use skeeks\cms\models\CmsTree;
use skeeks\cms\models\Tree;
use skeeks\cms\savedFilters\models\SavedFilters;
use \yii\base\InvalidConfigException;
use yii\caching\TagDependency;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Class SavedFiltersUrlRule
 *
 * @package skeeks\cms\savedFilters
 */
class SavedFiltersUrlRule
    extends \yii\web\UrlRule
{
    public function init()
    {
        if ($this->name === null)
        {
            $this->name = __CLASS__;
        }
    }

    static public $models = [];

    /**
     * @param \yii\web\UrlManager $manager
     * @param string $route
     * @param array $params
     * @return bool|string
     */
    public function createUrl($manager, $route, $params)
    {
        if ($route == 'savedFilters/saved-filters/view')
        {
            $suffix             = (string) ($this->suffix === null ? $manager->suffix : $this->suffix);

            $id          = (int) ArrayHelper::getValue($params, 'id');
            $treeModel   = ArrayHelper::getValue($params, 'model');

            if (!$id && !$treeModel)
            {
                return false;
            }

            if ($treeModel && $treeModel instanceof Tree)
            {
                $tree = $treeModel;
                self::$models[$treeModel->id] = $treeModel;
            } else
            {
                if (!$tree = ArrayHelper::getValue(self::$models, $id))
                {
                    $tree = SavedFilters::findOne(['id' => $id]);
                    self::$models[$id] = $tree;
                }
            }

            if (!$tree)
            {
                return false;
            }

            if ($tree->code)
            {
                //$url = $tree->dir . ((bool) \Yii::$app->seo->useLastDelimetrTree ? DIRECTORY_SEPARATOR : "") . (\Yii::$app->urlManager->suffix ? \Yii::$app->urlManager->suffix : '');
                $url = $tree->code . $suffix;
            } else
            {
                $url = "";
            }

            ArrayHelper::remove($params, 'id');
            ArrayHelper::remove($params, 'model');

            if (!empty($params) && ($query = http_build_query($params)) !== '') {
                $url .= '?' . $query;
            }

            return $url;
        }

        return false;
    }

    /**
     * @param \yii\web\UrlManager $manager
     * @param \yii\web\Request $request
     * @return array|bool
     */
    public function parseRequest($manager, $request)
    {
        if ($this->mode === self::CREATION_ONLY) {
            return false;
        }

        if (!empty($this->verb) && !in_array($request->getMethod(), $this->verb, true)) {
            return false;
        }

        $pathInfo           = $request->getPathInfo();
        if ($this->host !== null) {
            $pathInfo = strtolower($request->getHostInfo()) . ($pathInfo === '' ? '' : '/' . $pathInfo);
        }


        $params             = $request->getQueryParams();
        $suffix             = (string)($this->suffix === null ? $manager->suffix : $this->suffix);
        $treeNode           = null;

        $originalDir = $pathInfo;
        if ($suffix)
        {
            $originalDir = substr($pathInfo, 0, (strlen($pathInfo) - strlen($suffix)));
        }

        $dependency = new TagDependency([
            'tags'      =>
            [
                (new Tree())->getTableCacheTag(),
            ],
        ]);


        if (!$pathInfo) //главная страница
        {
            return false;

        } else //второстепенная страница
        {
            $treeNode = SavedFilters::find()->where([
                "code"                          => $originalDir,
            ])->one();
        }


        if ($treeNode)
        {
            $params['id']        = $treeNode->id;
            return ['savedFilters/saved-filters/view', $params];
        } else
        {
            return false;
        }
    }
}
