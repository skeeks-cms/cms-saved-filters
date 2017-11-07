SkeekS CMS saved filters
===================================

[![Latest Stable Version](https://poser.pugx.org/skeeks/cms-saved-filters/v/stable.png)](https://packagist.org/packages/skeeks/cms-saved-filters)
[![Total Downloads](https://poser.pugx.org/skeeks/cms-saved-filters/downloads.png)](https://packagist.org/packages/skeeks/cms-saved-filters)
[![Reference Status](https://www.versioneye.com/php/skeeks:cms-saved-filters/reference_badge.svg)](https://www.versioneye.com/php/skeeks:cms-saved-filters/references)
[![Dependency Status](https://www.versioneye.com/php/skeeks:cms-saved-filters/dev-master/badge.png)](https://www.versioneye.com/php/skeeks:cms-saved-filters/dev-master)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist skeeks/cms-saved-filters "*"
```

or add

```
"skeeks/cms-saved-filters": "*"
```

Configuration app
----------

```php

'components' =>
[
    'savedFilters' => [
        'class'     => 'skeeks\cms\savedFilters\SavedFiltersComponent',
    ],

    'urlManager' => [
        'rules' => [
            'skeeks\cms\savedFilters\SavedFiltersUrlRule' => [
                'class' => 'skeeks\cms\savedFilters\SavedFiltersUrlRule',
            ],
        ]
    ],

    'cms' =>
    [
        'relatedHandlers' => [
            'skeeks\cms\savedFilters\RelatedHandlerSavedFilter' =>
            [
                'class' => 'skeeks\cms\savedFilters\RelatedHandlerSavedFilter'
            ]
        ],
    ],

    'i18n' => [
        'translations' =>
        [
            'skeeks/savedFilters' => [
                'class'             => 'yii\i18n\PhpMessageSource',
                'basePath'          => '@skeeks/cms-saved-filters/savedFilters/messages',
                'fileMap' => [
                    'skeeks/savedFilters' => 'main.php',
                ],
            ]
        ]
    ]
],

'modules' =>
[
    'savedFilters' => [
        'class'         => 'skeeks\cms\savedFilters\SavedFiltersModule',
    ]
]

```

___

> [![skeeks!](https://skeeks.com/img/logo/logo-no-title-80px.png)](https://skeeks.com)  
<i>SkeekS CMS (Yii2) — quickly, easily and effectively!</i>  
[skeeks.com](https://skeeks.com) | [cms.skeeks.com](https://cms.skeeks.com)

