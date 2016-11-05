<?php 
namespace app\models;

use Yii;
use yii\base\Model;

class ModelSearch extends Model
{
	public $article;
    public $brand;

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
    	echo '<pre>'; print_r($this->article); echo '</pre>';
        $result = array();
        if (!$this->validate()) {
            return null;
        }

        return $result;
    }
}
 ?> 
