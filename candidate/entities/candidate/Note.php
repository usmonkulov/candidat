<?php

namespace candidate\entities\candidate;

use candidate\behaviors\AuthorBehavior;
use candidate\entities\user\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * This is the model class for table "note".
 *
 * @property int $id
 * @property int $deadline
 * @property string $description
 * @property int $candidate_id
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Candidate $candidate
 * @property User $createdBy
 * @property User $updatedBy
 */
class Note extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%note}}';
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

        return $behaviors;
    }

    public static function create
    (
        $candidate_id,
        $deadline,
        $description
    ): Note

    {
        $item = new static();
        $item->candidate_id = $candidate_id;
        $item->deadline = $deadline;
        $item->description = $description;
        return $item;
    }

    public function edit(
        $candidate_id,
        $deadline,
        $description
    )
    {
        $this->candidate_id = $candidate_id;
        $this->deadline = $deadline;
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['deadline', 'description', 'candidate_id'], 'required'],
            [['deadline', 'candidate_id', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['deadline', 'candidate_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['candidate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Candidate::class, 'targetAttribute' => ['candidate_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID raqami'),
            'deadline' => Yii::t('app', 'Intervyu vaqti (Kun)'),
            'description' => Yii::t('app', 'Qisqacha izoh'),
            'candidate_id' => Yii::t('app', 'Nomzod'),
            'created_by' => Yii::t('app', 'Yaratgan foydalanuvchi'),
            'updated_by' => Yii::t('app', 'Tehrirlagan foydalanuvchi'),
            'created_at' => Yii::t('app', 'Yaratilgan sana'),
            'updated_at' => Yii::t('app', 'Yangilangan sana'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getCandidate(): ActiveQuery
    {
        return $this->hasOne(Candidate::class, ['id' => 'candidate_id']);
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