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
//            'test' => new \app\Repo\test('test.com'),
            'ecat' => new \app\Repo\ecat('ecat.ua')
        );
        parent::__construct();
    }

    public function rules()
    {
        return [
            ['article', 'trim'],
            ['article', 'required'],
            ['article', 'string', 'min' => 2, 'max' => 255],
        ];
    }

    public function search()
    {
        $result = array();
        if (!$this->validate()) {
            return null;
        }
        foreach ($this->parseSiteList as $list_key => $value){
             $value->find($this->article, $this->brand);
//            echo $link;
//            $result=  $link;
    }
return $result;
}
}
?>
