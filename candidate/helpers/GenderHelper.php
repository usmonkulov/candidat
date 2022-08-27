<?php

namespace candidate\helpers;

use Yii;
use yii\helpers\Html;

class GenderHelper
{
    const GENDER_MALE = 'm';
    const GENDER_FEMALE = 'f';

    /**
     * @return array
     */
    public static function setLabel(): array
    {
        return [
            self::GENDER_MALE   => Yii::t('app', 'Erkak'),
            self::GENDER_FEMALE => Yii::t('app', 'Ayol'),
        ];
    }

    /**
     * @param string $gender
     * @return mixed
     */
    public static function getLabel(string $gender)
    {
        return self::setLabel()[$gender];
    }

    /**
     * @param $data
     * @param $url
     * @return mixed
     */
    public static function getGenderHtml($data)
    {
        return $data->gender == self::GENDER_MALE ? self::getLabel(self::GENDER_MALE) : self::getLabel(self::GENDER_FEMALE);
    }


    public static function getGenderForSelect()
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