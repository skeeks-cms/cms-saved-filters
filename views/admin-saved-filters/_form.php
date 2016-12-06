
<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 28.08.2015
 */
use yii\helpers\Html;
use skeeks\cms\modules\admin\widgets\form\ActiveFormUseTab as ActiveForm;

/* @var $this yii\web\View */
/* @var $model \skeeks\cms\import\models\ImportTask */
/* @var $handler \skeeks\cms\import\ImportHandler */
?>



<?php $form = ActiveForm::begin([
    'id'                                            => 'sx-import-form',
    'enableAjaxValidation'                          => false,
]); ?>

<? $this->registerJs(<<<JS

(function(sx, $, _)
{
    sx.classes.Import = sx.classes.Component.extend({

        _onDomReady: function()
        {
            var self = this;

            $("[data-form-reload=true]").on('change', function()
            {
                self.update();
            });
        },

        update: function()
        {
            _.delay(function()
            {
                var jForm = $("#sx-import-form");
                jForm.append($('<input>', {'type': 'hidden', 'name' : 'sx-not-submit', 'value': 'true'}));
                jForm.submit();
            }, 200);
        }
    });

    sx.Import = new sx.classes.Import();
})(sx, sx.$, sx._);


JS
); ?>

    <?= \skeeks\cms\modules\admin\widgets\BlockTitleWidget::widget(['content' => 'Базовые настройки']); ?>

<?= $form->field($model, 'is_active')->checkbox(); ?>
<?= $form->field($model, 'name'); ?>
<?= $form->field($model, 'code'); ?>
<?= $form->fieldInputInt($model, 'priority'); ?>

<?= $form->field($model, 'image_id')->widget(
    \skeeks\cms\widgets\formInputs\StorageImage::className()
); ?>

<?= $form->field($model, 'description_short')->widget(
    \skeeks\cms\widgets\formInputs\comboText\ComboTextInputWidget::className(),
    [
        'modelAttributeSaveType' => 'description_short_type',
    ]);
?>

<?= $form->field($model, 'description_full')->widget(
    \skeeks\cms\widgets\formInputs\comboText\ComboTextInputWidget::className(),
    [
        'modelAttributeSaveType' => 'description_full_type',
    ]);
?>

    <?= \skeeks\cms\modules\admin\widgets\BlockTitleWidget::widget(['content' => 'SEO']); ?>
    <?= $form->field($model, 'meta_title'); ?>
    <?= $form->field($model, 'meta_keywords')->textarea(['rows' => 3]); ?>
    <?= $form->field($model, 'meta_description')->textarea(['rows' => 3]); ?>

    <?= $form->field($model, 'component')->listBox(array_merge(['' => ' - '], \yii\helpers\ArrayHelper::map(
            \Yii::$app->savedFilters->handlers, 'id', 'name'
        )), [
        'size' => 1,
        'data-form-reload' => 'true'
    ]); ?>

<? if ($handler) : ?>
    <?= \skeeks\cms\modules\admin\widgets\BlockTitleWidget::widget([
        'content' => \Yii::t('skeeks/savedFilters', 'Handler settings')
    ]); ?>

        <?= $handler->renderConfigForm($form); ?>
<? endif; ?>

<?/* if (!$model->isFileExist && $model->file_path) : */?><!--
    <?/* \yii\bootstrap\Alert::begin([
        'options' => [
            'class' => 'alert-danger'
        ]
    ]); */?>
        <?/*= \Yii::t('skeeks/import', 'A  file path is set incorrectly or the file does not exist in the specified path'); */?>
    <?/* \yii\bootstrap\Alert::end(); */?>
--><?/* endif; */?>


<?= $form->buttonsStandart($model); ?>
<? if ($handler) : ?>

    <!--<hr />
    <?/*= $handler->renderWidget($form); */?>

    <br /><br />-->
<? endif; ?>

<?php ActiveForm::end(); ?>
