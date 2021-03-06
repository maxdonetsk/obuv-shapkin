<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wideness".
 *
 * @property integer $id
 * @property string $name
 * @property integer $position
 */
class Wideness extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wideness';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'position'], 'required'],
            [['position'], 'integer'],
            [['position'], 'unique'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Полнота',
            'position' => 'Позиция',
        ];
    }
}
