<?php

namespace candidate\entities\user;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $user_id
 * @property string $refresh_token
 * @property string $expired_date
 * @property string $ip
 * @property string $user_agent
 * @property int $created_at
 *
 * @property-read User $user
 */
class UserRefreshToken extends ActiveRecord
{
    /**
     * @return static
     */
    public static function create($user_id, $refresh_token, $expired_date, $ip, $user_agent)
    {
        $item = new static();
        $item->user_id = $user_id;
        $item->refresh_token = $refresh_token;
        $item->expired_date = $expired_date;
        $item->ip = $ip;
        $item->user_agent = $user_agent;
        return $item;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'public.user_refresh_token';
    }

    /**
     * @return array[]
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => date('Y-m-d H:i:s.u'),
            ]
        ];
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            [['user_id', 'refresh_token', 'ip', 'user_agent', 'expired_date'], 'required'],
            [['user_id'], 'integer'],
            [['refresh_token', 'ip', 'user_agent', 'expired_date'], 'string']
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}