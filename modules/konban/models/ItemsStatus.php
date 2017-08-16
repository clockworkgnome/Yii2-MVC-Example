<?php

namespace app\modules\konban\models;

use Yii;

/**
 * This is the model class for table "itemStatus".
 *
 * @property int $projectID
 * @property int $itemID
 * @property string $status
 * @property string $catagory
 * @property string $urgency
 *
 * @property Projects $project
 * @property Items $item
 */
class ItemsStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'itemStatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['projectID', 'itemID', 'status', 'catagory', 'urgency'], 'required'],
            [['projectID', 'itemID'], 'integer'],
            [['status', 'catagory', 'urgency'], 'string', 'max' => 100],
            [['projectID'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['projectID' => 'projectID']],
            [['itemID'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['itemID' => 'itemID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'projectID' => 'Project ID',
            'itemID' => 'Item ID',
            'status' => 'Status',
            'catagory' => 'Catagory',
            'urgency' => 'Urgency',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['projectID' => 'projectID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['itemID' => 'itemID']);
    }
}