<?php

namespace app\modules\konban\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "items".
 *
 * @property int $itemID
 * @property int $ownerID
 * @property string $title
 * @property string $created
 * @property string $updated
 * @property string $content
 *
 * @property ItemStatus[] $itemStatuses
 * @property User $owner
 * @property Messages[] $messages
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ownerID', 'title', 'created', 'updated'], 'required'],
            [['ownerID'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['title', 'content'], 'string', 'max' => 100],
            [['ownerID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['ownerID' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'itemID' => 'Item ID',
            'ownerID' => 'Owner ID',
            'title' => 'Title',
            'created' => 'Created',
            'updated' => 'Updated',
            'content' => 'Content',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemStatuses()
    {
        return $this->hasMany(ItemStatus::className(), ['itemID' => 'itemID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'ownerID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['itemID' => 'itemID']);
    }

}