<?php
namespace app\models;

use yii\base\Model;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;

/**
 * For the input of step form
 * @package app\models
 * @property string $userName
 * @property integer $steps
 * @property integer $position
 */
class UserForm extends Model
{
    public $position;
    public $userName;
    public $steps;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['steps'], 'required'],
            [['steps'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'steps' => 'Enter your answer',
        ];
    }

    /**
     * Read the resource file
     * @param string $name
     * @return array|mixed
     */
    public function readResourceFile($name='leaderboard.json')
    {
        if (empty($name)) {
            return [];
        }

        $data = \Yii::$app->cache->get($name);
        if (!empty($data)) {
            return $data;
        }

        $resourcFile = \Yii::getAlias('@app/resources').DIRECTORY_SEPARATOR.$name;
        if (!file_exists($resourcFile)) {
            return [];
        }
        $rawdata = file_get_contents($resourcFile);
        if (empty($rawdata)) {
            return [];
        }

        $data = Json::decode($rawdata);

        if (empty($data)) {
            return [];
        }

        $data = \Yii::$app->cache->set($name, $data);

        return $data;
    }

    /**
     * @param string $name
     * @return false|array
     */
    public function getUserInfo($name)
    {
        $users = $this->readResourceFile();
        foreach ($users as $key => $user) {
            if ($user['name'] === $name) {
                $this->position = $key;
                return $user;
            }
        }
        return false;
    }

    /**
     * @param array $user
     * @return string
     */
    public function getUserLogo($user)
    {
        if (!empty($user['image'])) {
            return Html::img('@web/images'.DIRECTORY_SEPARATOR.$user['image'], ['class' => "img-circle"]);
        }

        $name = '';
        if (!empty($user['name'])) {
            $words = preg_split("/\s+/", $user['name']);
            foreach ($words as $word) {
                $name .= strtoupper($word[0]);
            }
        }

        return Html::tag('div', $name, ['class'=>'avatar']);
    }

    /**
     * save data to cache for the page
     * @param string $cacheName
     * @return bool
     */
    public function saveStepInCache($cacheName='leaderboard.json')
    {
        $data = $this->readResourceFile($cacheName);
        if (empty($data)) {
            return false;
        }

        foreach ($data as $key => $user) {
            if ($user['name'] === $this->userName) {
                $data[$key]['points'] = $this->steps;
            }
        }

        //sort the array
        usort($data, function ($a, $b) {
            return $a['points'] < $b['points'];
        });

        \Yii::$app->cache->set($cacheName, $data);

        return true;
    }
}