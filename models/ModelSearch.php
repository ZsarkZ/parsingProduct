<?php
namespace app\models;

use Yii;
use yii\base\Model;

class ModelSearch extends Model
{
    public $article;
    public $brand;

    private $parseSiteList;

    public function __construct()
    {
        $this->parseSiteList = array(
            //'test'         => new \app\Repo\test('test.com'),
            //'ecat'         => new \app\Repo\ecat('ecat.ua'),
            'autooriginal' => new \app\Repo\ecat('autooriginal.de'),
            'avtoduma' => new \app\Repo\ecat('avtoduma.ua')
        );
        parent::__construct();
    }

    public function rules()
    {
        return [
            [['article', 'brand'], 'string'],

            ['article', 'trim'],
            ['article', 'required'],
            ['article', 'string', 'min' => 2, 'max' => 255],

            ['brand', 'trim'],

        ];
    }

    public function search()
    {
        $result = array();
        if (!$this->validate()) {
            return null;
        }
        foreach ($this->parseSiteList as $key => $siteClass){
            $result = array_merge($result, $siteClass->find($this->article, $this->brand));
        }
        echo '<pre>'; print_r($result); echo '</pre>';

        return $result;
    }
}
?>
