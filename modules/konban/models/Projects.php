<?php

namespace app\modules\konban\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property int $projectID
 * @property string $name
 * @property string $members
 * @property string $deadline
 * @property string $dateCreated
 *
 * @property ItemStatus[] $itemStatuses
 * @property Messages[] $messages
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'members', 'deadline', 'dateCreated'], 'required'],
            [['deadline', 'dateCreated'], 'safe'],
            [['name', 'members'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'projectID' => 'Project ID',
            'name' => 'Name',
            'members' => 'Members',
            'deadline' => 'Deadline',
            'dateCreated' => 'Date Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemStatuses()
    {
        return $this->hasMany(ItemStatus::className(), ['projectID' => 'projectID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['projectID' => 'projectID']);
    }
}