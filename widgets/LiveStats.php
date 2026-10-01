<?php

namespace k7zz\humhub\bbb\widgets;

use humhub\components\Widget;
use k7zz\humhub\bbb\models\Session;
use k7zz\humhub\bbb\services\SessionService;
use Yii;

/**
 * Widget: live statistics of a running BBB meeting.
 *
 * Renders participants, moderators, webcam counts, recording state
 * and start time. Must be placed inside an element with data-bbb-check-state;
 * the values are kept up to date by the BBBHelpers polling (see Helpers.js).
 */
class LiveStats extends Widget
{
    public Session $session;
    public bool $running = false;
    /** @var string Extra CSS classes for the container */
    public string $cssClass = '';

    public function run()
    {
        $info = null;
        if ($this->running) {
            try {
                $info = (new SessionService())->getLiveInfo($this->session);
            } catch (\Throwable $e) {
                Yii::error($e, 'bbb');
            }
        }

        return $this->render('liveStats', [
            'info' => $info,
            'cssClass' => $this->cssClass,
        ]);
    }
}
