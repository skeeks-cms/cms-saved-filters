<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 15.04.2016
 */
return
[
    'content' =>
    [
        'items' =>
        [
            "savedFilters" =>
            [
                "label"     => \Yii::t('skeeks/savedFilters', "Saved filters"),
                //"img"       => ['\skeeks\cms\import\assets\ImportAsset', 'icons/import.png'],
                "url"       => ["savedFilters/admin-saved-filters"],

                'items' =>
                [
                    [
                        "label"     => \Yii::t('skeeks/savedFilters', "Saved filters"),
                        //"img"       => ['\skeeks\cms\import\assets\ImportAsset', 'icons/import.png'],
                        "url"       => ["savedFilters/admin-saved-filters"],
                    ]/*,

                    [
                        "label"     => \Yii::t('skeeks/import', "CSV"),
                        "img"       => ['\skeeks\cms\import\assets\ImportAsset', 'icons/csv.png'],
                        "url"       => ["cmsImport/admin-import-task"],
                    ],*/
                ],
            ],
        ]
    ]
];