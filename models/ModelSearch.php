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
            'test' => new \app\Repo\test('test.com'),
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
        $this->parseSiteList['test']->find($this->article, $this->brand);
        return $result;
    }
}
 ?> 
