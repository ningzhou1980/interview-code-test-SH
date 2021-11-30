<?php
/**
 * @var $this yii\web\View
 * @var $model UserForm
 */

use app\models\UserForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = 'My page';

$users = $model->readResourceFile();
$currentUser = $model->getUserInfo($model->userName);
?>
<div class="row">
    <nav class="col-sm-4 d-none sidebar">
        <botton class="row" id="user" data-toggle="collapse" data-target="#other-info">
            <div class="col-sm-12 well">
                <div class="logo">
                    <?= $model->getUserLogo($currentUser) ?>
                    <span class="badge badge-light">#<?= $model->position+1 ?></span>
                </div>
                <div class="detail">
                    <div class="name"><?= Html::encode(strtoupper($currentUser['name'])) ?></div>
                    <div class="description">CHALLENGE POINTS</div>
                    <div class="point"><?= Yii::$app->formatter->asInteger($currentUser['points']) ?></div>
                </div>
            </div>
        </botton>

        <div id="other-info">
            <div class="row" id="rankings">
                <div class="col-xs-12 well">
                    <div class="list-group">
                        <div class="header">
                            <div class="logo img-circle">
                                <?= Html::img('@web/images'.DIRECTORY_SEPARATOR.'trophy.svg') ?>
                            </div>
                            <div class="detail">
                                <div class="name">OVERALL</div>
                                <div class="description">RANKINGS</div>
                            </div>
                        </div>
                        <?php
                        foreach ($users as $index => $user) {
                            $className = ($index % 2 === 0) ? ' even' : ' odd';
                            $className .= $index === $model->position ? ' active' : '';
                            ?>
                            <button class="list-group-item<?= $className ?>">
                                <span class="col-xs-8 text-left">
                                    <?= $model->getUserLogo($user) ?>
                                    <span class="rank"><?= ($index+1)."." ?></span>
                                    <span class="name"><?= Html::encode($user['name']) ?></span>
                                </span>
                                <span class="col-xs-4 text-right">
                                    <strong><?= Yii::$app->formatter->asInteger($user['points']) ?>pts</strong>
                                </span>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row" id="about">
                <div class="well">
                    <div class="header">
                        <?= Html::img('@web/images'.DIRECTORY_SEPARATOR.'question.svg') ?>
                        <div class="title">ABOUT</div>
                        <div class="date">Close on <strong>Wednesday, 23 Dec. 2021, 5:00AM</strong></div>
                    </div>
                    <p>
                        'SHIFT' was designed to show you how a seemingly small change, like adding more steps into your day
                        with your team, can have a huge impact on you and those with whom you participated.
                    </p>
                </div>
            </div>
        </div>
    </nav>
    <div class="col-sm-8 main">
        <div class="well">
            <h2>SHIFT CHALLENGE</h2>
            <div class="banner">
            </div>
            <div class="content">
                <div class="date"><?= date('l, M. d') ?></div>
                <h1>TRACK YOUR STEPS</h1>
                <p class="hint-block">Using your movement-tracking device, keep track of the number of steps you take each day.</p>
                <p><strong>Enter your step count for this day</strong></p>
                <div class="form">
                    <?php
                    $form = ActiveForm::begin(['id' => 'article-update-form'])
                    ?>

                    <?= $form->field($model, 'steps', [
                        'template' => '{beginLabel}{labelTitle}{endLabel}<div class="input-group">{input}
                <span class="input-group-addon">steps</span></div>{error}{hint}'
                    ])->textInput(); ?>

                    <div class="form-group">
                        <?= Html::submitButton('SAVE ANSWER', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
