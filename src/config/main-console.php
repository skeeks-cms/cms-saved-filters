<?php
return [
    'components' =>
    [
        'savedFilters' => [
            'class'     => 'skeeks\cms\savedFilters\SavedFiltersComponent',
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