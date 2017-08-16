<?php

namespace app\modules\konban\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $ownerID
 * @property int $itemID
 * @property int $projectID
 * @property int $to
 * @property int $messageID
 * @property string $message
 *
 * @property User $owner
 * @property Items $item
 * @property Projects $project
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ownerID', 'itemID', 'projectID', 'to'], 'required'],
            [['ownerID', 'itemID', 'projectID', 'to'], 'integer'],
            [['message'], 'string', 'max' => 100],
            [['ownerID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['ownerID' => 'id']],
            [['itemID'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['itemID' => 'itemID']],
            [['projectID'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['projectID' => 'projectID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ownerID' => 'Owner ID',
            'itemID' => 'Item ID',
            'projectID' => 'Project ID',
            'to' => 'To',
            'messageID' => 'Message ID',
            'message' => 'Message',
        ];
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
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['itemID' => 'itemID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['projectID' => 'projectID']);
    }
}