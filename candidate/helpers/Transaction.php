<?php

namespace candidate\helpers;

use Yii;

class Transaction
{
    /**
     * @param $callable
     * @return mixed
     * @throws \Throwable
     */
    public function wrap($callable)
    {
        return Yii::$app->db->transaction($callable);
    }
}