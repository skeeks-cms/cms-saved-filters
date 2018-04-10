<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 13.09.2016
 */
namespace skeeks\cms\savedFilters;

use skeeks\cms\savedFilters\models\SavedFilters;

class ExportSitemapHandler extends \skeeks\cms\exportSitemap\ExportSitemapHandler {

    public function init()
    {
        parent::init();
        $this->name = \Yii::t('skeeks/exportSitemap', 'Генерация sitemap.xml с сохраненными фильтрами.');
    }

    protected function _exportAdditional()
    {
        $query = SavedFilters::find()->where(['is_active' => true]);
        return $this->_exportByQuery($query, "saved-filter", function(SavedFilters $savedFilters) {
            return [
                'loc' => $savedFilters->getUrl(true),
                "lastmod" => $this->_lastMod($savedFilters),
            ];
        });
    }
}