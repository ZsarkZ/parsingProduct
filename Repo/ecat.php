<?php
namespace app\Repo;

use Yii;
use GuzzleHttp\Client;
use phpQuery;

class ecat extends BaseRepo
{
    public function find($article, $brand = '')
    {

        $brand='False';
        $idadd='ctl00_cphBody_ArticleBrowserCtl_lvParts_';
        $client = new Client();
        $res = $client->request('GET', "http://ecat.ua/ArticleBrowser.aspx?TT=ftx&SearchPtn=".$article."+&EM=".$brand."");
        $body = $res->getBody();
        $document = phpQuery::newDocumentHTML($body);

//        $links = $document->find( $idadd."^ > a");
        $links = $document->find("td[id^={$idadd}]>a");

        foreach ($links as $link) {
            echo pq($link)->text().'<br>';
//            echo pq($link);
//            var_dump($link);
//            preg_match();
        }
//#ctl00_cphBody_ArticleBrowserCtl_lvParts_Item1901020801_tdActiveNumber1901020801 > a)
////        id="ctl00_cphBody_ArticleBrowserCtl_lvParts_Item1901020802_tdActiveNumber1901020802
//        #ctl00_cphBody_ArticleBrowserCtl_lvParts_
//        #ItemSDM19010_tdActiveNumberSDM19010 > a:nth-child(3)
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
