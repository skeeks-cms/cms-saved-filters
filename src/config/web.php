<?php
return [

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