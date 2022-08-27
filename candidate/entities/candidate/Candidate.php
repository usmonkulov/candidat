<?php

namespace candidate\entities\candidate;

use candidate\behaviors\AuthorBehavior;
use candidate\behaviors\candidate\StatusAndIsDeletedBehavior;
use candidate\entities\user\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "{{%candidate}}".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $middle_name
 * @property string|null $address
 * @property string|null $country_origin
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $birthday
 * @property bool|null $hired
 * @property string $gender
 * @property int|null $status
 * @property int|null $is_deleted
 * @property string $token
 * @property string $request_no
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at

 * @property User $createdBy
 * @property Note $note
 * @property User $updatedBy

 */
class Candidate extends ActiveRecord
{

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%candidate}}';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['timestamp'] = [
            'class' => TimestampBehavior::class,
            'attributes' => [
                ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
            ],
            'value' => new Expression('NOW()'),
        ];

        $behaviors['author'] = [
            'class' => AuthorBehavior::class,
        ];

        $behaviors['statusAndIsDeleted'] = [
            'class' => StatusAndIsDeletedBehavior::class,
        ];

        return $behaviors;
    }

    public static function create
    (
        $first_name,
        $last_name,
        $middle_name,
        $address,
        $country_origin,
        $email,
        $phone,
        $birthday,
        $hired,
        $gender,
        $status,
        $is_deleted
    ): Candidate
    {
        $item = new static();
        $item->first_name = $first_name;
        $item->last_name = $last_name;
        $item->middle_name = $middle_name;
        $item->address = $address;
        $item->country_origin = $country_origin;
        $item->email = $email;
        $item->phone = $phone;
        $item->birthday = $birthday;
        $item->hired = $hired;
        $item->gender = $gender;
        $item->status = $status;
        $item->is_deleted = $is_deleted;
        return $item;
    }

    public function edit(
        $first_name,
        $last_name,
        $middle_name,
        $address,
        $country_origin,
        $email,
        $phone,
        $birthday,
        $hired,
        $gender,
        $status,
        $is_deleted
    )
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->middle_name = $middle_name;
        $this->address = $address;
        $this->country_origin = $country_origin;
        $this->email = $email;
        $this->phone = $phone;
        $this->birthday = $birthday;
        $this->hired = $hired;
        $this->gender = $gender;
        $this->status = $status;
        $this->is_deleted = $is_deleted;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['birthday'], 'date', 'format' => 'php:Y-m-d'],
            [['first_name', 'last_name', 'address', 'country_origin', 'phone', 'birthday','gender'], 'required'],
            [['address'], 'string'],
            [['is_deleted', 'status'], 'integer'],
            [['hired'], 'boolean'],
            ['hired', 'default', 'value' => false],
            [['first_name', 'last_name', 'middle_name', 'country_origin'], 'string', 'max' => 255],
            [['email', 'phone'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 1],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }


    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID raqami'),
            'first_name' => Yii::t('app', 'Familiya'),
            'last_name' => Yii::t('app', 'Ism'),
            'middle_name' => Yii::t('app', 'Otasining ismi'),
            'address' => Yii::t('app', 'Manzil'),
            'country_origin' => Yii::t('app', 'Davlat nomi'),
            'email' => Yii::t('app', 'Elektron pochta'),
            'phone' => Yii::t('app', 'Telefon'),
            'birthday' => Yii::t('app', 'Tug\'ilgan kun'),
            'age' => Yii::t('app', 'Yosh'),
            'hired' => Yii::t('app', 'Ishga qabul qilingan'),
            'gender' => Yii::t('app', 'Jinsi'),
            'status' => Yii::t('app', 'Holati'),
            'is_deleted' => Yii::t('app', 'Oʻchirilgan'),
            'request_no' => Yii::t('app', 'Ariza raqami'),
            'created_by' => Yii::t('app', 'Yaratgan foydalanuvchi'),
            'updated_by' => Yii::t('app', 'Tahrirlagan foydalanuvchi'),
            'token' => Yii::t('app', 'Holatni tekshirish kodi'),
            'created_at' => Yii::t('app', 'Yaratilgan vaqti'),
            'updated_at' => Yii::t('app', 'Yangilangan vaqti'),
        ];
    }

    /**
     * @return false|string
     */
    public function getAgo(){
        return date("Y") - date('Y',strtotime($this->birthday));
    }

    /**
     * @return ActiveQuery
     */
    public function getNote(): ActiveQuery
    {
        return $this->hasOne(Note::class, ['candidate_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCreatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUpdatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}