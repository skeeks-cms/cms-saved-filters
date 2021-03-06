<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 31.03.2016
 */
/* @var $this yii\web\View */


?>

<? $pjax = \skeeks\cms\modules\admin\widgets\Pjax::begin(); ?>

    <?php echo $this->render('_search', [
        'searchModel'   => $searchModel,
        'dataProvider'  => $dataProvider
    ]); ?>

    <?= \skeeks\cms\modules\admin\widgets\GridViewStandart::widget([
        'dataProvider'      => $dataProvider,
        'filterModel'       => $searchModel,
        'pjax'              => $pjax,
        'adminController'   => $controller,
        'columns' =>
        [
            'id',
            'code',
            'name',
            [
                'class' => \yii\grid\DataColumn::className(),
                'attribute' => 'component',
                'filter' => \yii\helpers\ArrayHelper::map(\Yii::$app->savedFilters->handlers, 'id', 'name'),
                'value'  => function(\skeeks\cms\savedFilters\models\SavedFilters $importTask)
                {
                    return $importTask->handler->name;
                }
            ],
            [
                'class' => \yii\grid\DataColumn::className(),
                'format' => 'raw',
                'value'  => function(\skeeks\cms\savedFilters\models\SavedFilters $savedFilters)
                {
                    return \yii\helpers\Html::a('<i class="glyphicon glyphicon-arrow-right"></i>', $savedFilters->url, [
                        'data-pjax' => 0,
                        'target' => '_blank',
                        'class' => 'btn btn-default btn-sm'
                    ]);
                }
            ]
        ]

    ]); ?>

<? $pjax::end() ?>
