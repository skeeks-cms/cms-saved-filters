<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright (c) 2010 SkeekS
 * @date 08.12.2017
 */
/* @var $this yii\web\View */
/* @var $action \skeeks\cms\backend\actions\BackendModelUpdateAction */
$context = $this->context;
$action = $context->action;
$dynamicModel = $action->dynamicModel;
?>
<? $form = $action->beginActiveForm(); ?>
<?php echo $form->errorSummary($dynamicModel); ?>

    <?php echo $form->field($dynamicModel, 'saved_filter_id')->widget(
        \skeeks\widget\chosen\Chosen::class,
        [
            'items' => \yii\helpers\ArrayHelper::map(
                \skeeks\cms\savedFilters\models\SavedFilters::find()->all(),
                'id',
                'name'
            )
        ]
    ); ?>

<?= $form->buttonsCreateOrUpdate($dynamicModel); ?>
<? $action->endActiveForm(); ?>
