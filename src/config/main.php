<?php
return [

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
];