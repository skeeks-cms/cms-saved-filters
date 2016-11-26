SkeekS CMS saved filters
===================================

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
                'basePath'          => '@skeeks/cms/savedFilters/messages',
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

##Links
* [Web site](http://en.cms.skeeks.com)
* [Web site (rus)](http://cms.skeeks.com)
* [Author](http://skeeks.com)
* [ChangeLog](https://github.com/skeeks-cms/cms-saved-filters/blob/master/CHANGELOG.md)


___

> [![skeeks!](https://gravatar.com/userimage/74431132/13d04d83218593564422770b616e5622.jpg)](http://skeeks.com)  
<i>SkeekS CMS (Yii2) — quickly, easily and effectively!</i>  
[skeeks.com](http://skeeks.com) | [en.cms.skeeks.com](http://en.cms.skeeks.com) | [cms.skeeks.com](http://cms.skeeks.com) | [marketplace.cms.skeeks.com](http://marketplace.cms.skeeks.com)


