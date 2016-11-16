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
            'ecat'         => new \app\Repo\ecat('ecat.ua'),
            'autooriginal' => new \app\Repo\autooriginal('autooriginal.de'),
            'avtoduma' => new \app\Repo\avtoduma('avtoduma.ua')
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
            $siteResult = $siteClass->find($this->article, $this->brand);
            if (isset($result['Origin'])) {
                $result['Origin'] = array_merge($result['Origin'], $siteResult['Origin']);
            }
            if (isset($result['ReplacementOriginal'])) {
                $result['ReplacementOriginal'] = array_merge($result['ReplacementOriginal'], $siteResult['ReplacementOriginal']);
            } 
            if (isset($result['replaceNonOriginal'])) {
               $result['replaceNonOriginal'] = array_merge($result['replaceNonOriginal'], $siteResult['replaceNonOriginal']);
            }
            if (empty($result)) {
               $result = array_merge($result, $siteResult);
            }
        }
        return $result;
    }
}
?>
