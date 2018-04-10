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