<?php

namespace candidate\status;


use Yii;
use yii\helpers\Html;

class CandidateStatus
{
    const STATUS_NEW = 1;
    const STATUS_INTERVIEW_SCHEDULED = 2;
    const STATUS_ACCEPTED = 3;
    const STATUS_NOT_ACCEPTED = 4;

    /**
     * @return array
     */
    public static function setLabel(): array
    {
        return [
            self::STATUS_NEW                    => Yii::t('app', 'Yangi'),
            self::STATUS_INTERVIEW_SCHEDULED    => Yii::t('app', 'Intervyu belgilangan'),
            self::STATUS_ACCEPTED               => Yii::t('app', 'Qabul qilingan'),
            self::STATUS_NOT_ACCEPTED           => Yii::t('app', 'Qabul qilinmagan'),
        ];
    }


    /**
     * @param string $status
     * @return mixed
     */
    public static function getLabel(string $status)
    {
        return self::setLabel()[$status];
    }

    /**
     * @param $data
     * @param $url
     * @return mixed
     */
    public static function getStatusHtml($data, $url)
    {
            if($data->status < self::STATUS_NOT_ACCEPTED){
                $candidateStatus = self::getLabel($data->status + self::STATUS_NEW);
            } else {
                $candidateStatus = self::getLabel(self::STATUS_NEW);
            }

            if($data->status == self::STATUS_NEW){
                $buttonClass = 'info';
            }elseif ($data->status == self::STATUS_INTERVIEW_SCHEDULED){
                $buttonClass = 'primary';
            }elseif ($data->status == self::STATUS_ACCEPTED){
                $buttonClass = 'success';
            }elseif ($data->status == self::STATUS_NOT_ACCEPTED){
                $buttonClass = 'danger';
            }
            return Html::a(self::getLabel($data->status),
                ['activate', 'id' => $data->id, 'status' => $url],
                [
                    'title' => $candidateStatus . " қилиш",
                    'class' => 'btn btn-'. $buttonClass . ' btn-sm text-white'
                ]
            );
    }

    /**
     * @return array
     */
    public static function getStatusForSelect(): array
    {
        $list = [];
        foreach (self::setLabel() as $key => $item) {
            $list[] = [
                'id' => $key,
                'value' => $item
            ];
        }
        return $list;
    }
}