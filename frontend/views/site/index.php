<?php

/* @var $this yii\web\View */

use candidate\repositories\candidate\CandidateRepository;
use candidate\status\CandidateStatus;

$this->title = Yii::t('app', 'Bosh sahifa');
?>
<div class="site-index">
    <div class="container">
        <br><br>
        <div class="row text-center">
            <div class="col">
                <div class="counter">
                    <h2 class="timer count-title count-number" data-to="100" data-speed="1500"><?=CandidateRepository::getCount(CandidateStatus::STATUS_NEW)?></h2>
                    <p class="count-text "><?=CandidateStatus::getLabel(CandidateStatus::STATUS_NEW)?></p>
                </div>
            </div>
            <div class="col">
                <div class="counter">
                    <h2 class="timer count-title count-number" data-to="1700" data-speed="1500"><?=CandidateRepository::getCount(CandidateStatus::STATUS_INTERVIEW_SCHEDULED)?></h2>
                    <p class="count-text "><?=CandidateStatus::getLabel(CandidateStatus::STATUS_INTERVIEW_SCHEDULED)?></p>
                </div>
            </div>
            <div class="col">
                <div class="counter">
                    <h2 class="timer count-title count-number" data-to="11900" data-speed="1500"><?=CandidateRepository::getCount(CandidateStatus::STATUS_ACCEPTED)?></h2>
                    <p class="count-text "><?=CandidateStatus::getLabel(CandidateStatus::STATUS_ACCEPTED)?></p>
                </div></div>
            <div class="col">
                <div class="counter">
                    <h2 class="timer count-title count-number" data-to="157" data-speed="1500"><?=CandidateRepository::getCount(CandidateStatus::STATUS_NOT_ACCEPTED)?></h2>
                    <p class="count-text "><?=CandidateStatus::getLabel(CandidateStatus::STATUS_NOT_ACCEPTED)?></p>
                </div>
            </div>
        </div>
    </div>
</div>
