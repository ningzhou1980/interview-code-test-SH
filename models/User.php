<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class User
 * the model of the database table
 * @package app\models
 * @property integer $id
 * @property string $username
 * @property string $image
 * @property integer $steps
 */
class User extends ActiveRecord
{

    public function rules()
    {
        return [
            [['id', 'username'], 'required'],
            [['id', 'steps'], 'integer'],
            [['username', 'image'], 'string', 'max'=>64],
        ];
    }
}
