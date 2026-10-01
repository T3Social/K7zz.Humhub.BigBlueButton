<?php
/**
 * Widget view: live statistics of a running BBB meeting.
 *
 * Each value lives in a [data-bbb-stat] element so Helpers.js can update it from
 * the is-running poll response ("live" key).
 *
 * @var array|null $info  See SessionService::getLiveInfo()
 * @var string $cssClass
 */

use humhub\modules\ui\icon\widgets\Icon;
use humhub\helpers\Html;

$stats = [
    'participants' => ['users', Yii::t('BbbModule.base', 'Participants')],
    'moderators' => ['key', Yii::t('BbbModule.base', 'Moderators')],
    'video' => ['video-camera', Yii::t('BbbModule.base', 'Webcams')],
];
$startTime = $info['startTime'] ?? null;
?>
<div class="bbb-live-stats <?= Html::encode($cssClass) ?>" data-bbb-live-stats
    style="display: <?= $info ? '' : 'none' ?>;">
    <span class="bbb-live-stat" data-bbb-stat="startTime"
        title="<?= Html::encode(Yii::t('BbbModule.base', 'Running since')) ?>">
        <?= Icon::get('clock-o') ?>
        <span class="bbb-live-stat-value">
            <?= $startTime ? Yii::$app->formatter->asTime($startTime, 'short') : '' ?>
        </span>
    </span>
    <?php foreach ($stats as $key => [$icon, $label]): ?>
        <span class="bbb-live-stat" data-bbb-stat="<?= $key ?>" title="<?= Html::encode($label) ?>">
            <?= Icon::get($icon) ?> <span class="bbb-live-stat-value"><?= (int) ($info[$key] ?? 0) ?></span>
        </span>
    <?php endforeach; ?>
    <span class="bbb-live-stat text-danger" data-bbb-stat="recording"
        title="<?= Html::encode(Yii::t('BbbModule.base', 'Recording')) ?>"
        style="display: <?= !empty($info['recording']) ? '' : 'none' ?>;">
        <?= Icon::get('circle') ?> <span class="bbb-live-stat-value">REC</span>
    </span>
</div>