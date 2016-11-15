<?php 
namespace app\Repo;

use Yii;
use GuzzleHttp\Client;
use phpQuery;

class test extends BaseRepo
{
	public function find($article, $brand = '')
	{
        $client = new Client();
        $res = $client->request('GET', 'https://ru.wikipedia.org/wiki/%D0%A4%D0%B0%D0%BA%D1%82%D0%BE%D1%80%D1%8B_%D1%80%D0%BE%D1%81%D1%82%D0%B0_%D1%84%D0%B8%D0%B1%D1%80%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D0%BE%D0%B2');
        $body = $res->getBody();
        $document = phpQuery::newDocumentHTML($body);
        $links = $document->find("a");
         foreach ($links as $link) {
         	echo pq($link)->attr('href').'<br>';
         }


		$result[$this->siteUrl] = array(
			'Origin' => array(), 
			'ReplacementOriginal' => array(),
			'replaceNonOriginal' => array()
		);
		return $result;
	}
//	public login($login , $parol){
////	echo $login , $parol;
//
//}
}
?> 
