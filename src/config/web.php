<?php
return [

    'container' => [
        'definitions' => [
            \skeeks\cms\controllers\AdminTreeController::class => [
                'actionsMap' => [
                    'saved-filter' => [
                        'class' => 'skeeks\cms\savedFilters\actions\CmsTreeSavedFilterAction'
                    ]
                ]
            ]
        ],
    ],

    'components' =>
    [
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
    ],

];