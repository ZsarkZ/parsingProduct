<?php
namespace app\Repo;

use Yii;
use GuzzleHttp\Client;
use phpQuery;

class ecat extends BaseRepo
{
    private $shablone;
    private $oridgiral_prise = array();

    public function find($article, $brand = '')
    {
        $jar = new \GuzzleHttp\Cookie\CookieJar;
        $brand = 'False';
        $idadd = 'ctl00_cphBody_ArticleBrowserCtl_lvParts_';
        $client = new Client(['cookies' => true]);
//        $res = $client->request('GET', "http://ecat.ua/ArticleBrowser.aspx?TT=ftx&SearchPtn=" . $article . "+&EM=" . $brand . "");
        $res = $client->request('GET', "http://ecat.ua/Rul-ova-tyaga-SIDEM-SDM-19010/005JlJFRlBBR0U9QXJ0aWNsZUJyb3dzZXImVFQ9ZnR4JlBhcnREZXRhaWxJRD1TRE0gMTkwMTA=");
        if ($res->getStatusCode() == 200) {
            if ($res->hasHeader('content-length')) {
//               echo $contentLength=$res->getHeader('x-test-header');
            }
//             $res->getProtocol();        // >>> HTTP
        }
        $body = $res->getBody(true);
//        ctl00_styleMain
        $document = phpQuery::newDocumentHTML($body);

//         $product_a = $document->find("link[id=ctl00_styleMain]")->attr('href');
//         $r = substr($product_a, 2);
//         $links="http://ecat.ua{$r}";
//        $res_2 = $client->request('GET', $links);
//        if ($res_2->getStatusCode() == 200) {
//                $body_2 = $res_2->getBody(true);
//        }
//           echo "__doPostBack('ctl00$cphBody$ArtDetailControl$lbOENumbers','')";
        $headers = ['Host' => 'ecat.ua',
            'User-Agent' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language' => 'uk,ru;q=0.8,en-US;q=0.5,en;q=0.3',
            'Accept-Encoding' => 'gzip, deflate',
            'Referer' => 'http://ecat.ua/Rul-ova-tyaga-SIDEM-SDM-19010/005JlJFRlBBR0U9QXJ0aWNsZUJyb3dzZXImVFQ9ZnR4JlBhcnREZXRhaWxJRD1TRE0gMTkwMTA=',
            'Cookie' => 'history-guid-cookie=68417053-bf08-47d9-9ecc-b3574807ac37; _ga=GA1.2.756972817.1478180818; homepagerotation=1; Culture=ru-RU; ASP.NET_SessionId=awx45kwlubstak4ecbnmhcku; BALANCEID=ecatclusternew.node88; _gat=1',
            'Connection' => 'keep-alive',
            'Upgrade-Insecure-Requests' => '1'];


//        http://ecat.ua/Rul-ova-tyaga-SIDEM-SDM-19010/005JlJFRlBBR0U9QXJ0aWNsZUJyb3dzZXImVFQ9ZnR4JlBhcnREZXRhaWxJRD1TRE0gMTkwMTA=
//        http://ecat.ua/Rul-ova-tyaga-SIDEM-SDM-19010/005JlJFRlBBR0U9QXJ0aWNsZUJyb3dzZXImVFQ9ZnR4JlBhcnREZXRhaWxJRD1TRE0gMTkwMTA=
        $res2 = $client->request('POST', "http://ecat.ua/Rul-ova-tyaga-SIDEM-SDM-19010/005JlJFRlBBR0U9QXJ0aWNsZUJyb3dzZXImVFQ9ZnR4JlBhcnREZXRhaWxJRD1TRE0gMTkwMTA=", ['headers' => $headers,]);
        if ($res2->getStatusCode() == 200) {
            echo 1;
            echo $body2 = $res2->getBody(true);

            $res3 = $client->request('GET', "http://ecat.ua/Rul-ova-tyaga-SIDEM-SDM-19010/005JlJFRlBBR0U9QXJ0aWNsZUJyb3dzZXImVFQ9ZnR4JlBhcnREZXRhaWxJRD1TRE0gMTkwMTA=");
            if ($res3->getStatusCode() == 200) {
                echo 2;

//                echo $body = $res3->getBody(true);

            }

        }

//          $name_link = pq($product_a)->text();


//                    $res2 = $client->request('POST', );
//        echo $res->getStatusCode();
//        echo $res->getHeader('Content-Length');
//        echo $res->getHeaders()['Content-Type']; // PHP 5.4


//                   $document = phpQuery::newDocumentHTML($body);
//                    $product_a = $document->find("id=ctl00_cphBody_ArtDetailControl_pnlProductCode]");

//          $name_link = pq($product_a)->text();


//        $links = $document->find( $idadd."^ > a");
//        $links = $document->find("td[id^={$idadd}]>a");
//        $this->shablone = "$+" . $article . "\n";

//        foreach ($links as $link) {
//            pq($link)->text() . '<br>';
////          echo  $name_link = pq($link)->text();
////            $result1[][1] = preg_match_all($this->shablone, $name_link, $resul);
////            if ($resul) {
////                echo pq($link)->attr('href');
////            }
//            $name_product2 = pq($link)->text();
//            $aray_name_produrct = explode(" ", $name_product2);
////            var_dump($aray_name_produrct);
//            foreach ($aray_name_produrct as $poduct) {
////                var_dump($poduct);
//
//                if ($poduct === $article) {
////                    var_dump($poduct);
//                    $oridginal_ling = pq($link)->attr('href');
//                }
//            }
////            var_dump($result1);
////            $result1[]=preg_match("/".$article."/",$name_link);
////                var_dump($result1);
////            if ($result1) {
////                echo "Вхождение найдено.";
////                echo pq($link)->attr('href').'<br>';
////            echo pq($link);
////            } else {
////                echo "Вхождение не найдено.";
////            }
////            echo pq($link);
////            var_dump($link);
////            preg_match();
//        }
//        echo  $http_link='"'."{$oridginal_ling}".'"';
//         $http_link='"'."{$oridginal_ling}".'"';
//        var_dump($http_link);

//        if($oridginal_ling) {
//            $res2 = $client->request('GET', $oridginal_ling);
//          $body2 = $res2->getBody();
//            $document2 = phpQuery::newDocumentHTML($body2);
//
//          echo  $product_a = $document2->find("id=ctl00_cphBody_ArtDetailControl_lblProductCodeValue]")->eq(0);
////          echo  $product_b = $document2->find("id=ctl00_cphBody_ArtDetailControl_lblSupplierValue]")->eq(0);
////          echo  $product_c = $document2->find("id=ctl00_cphBody_ArtDetailControl_lblPrizeFinalValue]")->eq(0);
////          echo  $product_d = $document2->find("id=ctl00_cphBody_ArtDetailControl_tbQuantity]")->eq(0);
////            var_dump($product);
////            $id_artigl='ctl00_cphBody_ArtDetailControl';
////            $id_artigl2 ='ctl00_cphBody_ArtDetailControl_lblSupplierValue';
////          $links4[] = $document2->find("td[^={$id_artigl}>");
////            $links4 = $document2->find("td[id^={$id_artigl}]>span");
////            foreach ($product_d as $li) {
////                echo pq($li)->value().'<br>';
////            }
////            $links_price = $document2->find("span[id^={$id_artigl2}]");
//////            $links4 = $document2->find("td[id^={$id_artigl}]>span");
////            foreach ($links_price as $link2) {
////                echo pq($link2)->text() . '<br>';
////
////            }
//
//        }
//              $this->oridgiral_prise = ('number'=>$a,
//        'name'=>$a,
//        'supplier'=>$a,
//                'available'=>$a,
//        'price'=>$a,
//        'order_links'=>$a
//
//    );

//        $aray_dani_post=array();
//        if($http_link) {
//            $res2 = $client->request('POST', $oridginal_ling);
//            $body2 = $res2->getBody();
//            $document2 = phpQuery::newDocumentHTML($body2);
//            $links2 = $document2->find("span[id=ctl00_cphBody_ArtDetailControl_lblPrizeFinalValue]");
////          echo  $product = $document2->find("span[id=ctl00_cphBody_ArtDetailControl_lblPrizeFinalValue]");
//            $id_artigl='ctl00_cphBody_ArtDetailControl';
////            $links4[] = $document2->find("td[^={$id_artigl}>");
//            $links4 = $document2->find("td[id^={$id_artigl}]>span");
//            foreach ($links4 as $link2) {
//                echo pq($link2)->text() . '<br>';
//
//            }

//        }
//        http://ecat.ua/Rul-ova-tyaga-SIDEM-SDM-19010/005JlJFRlBBR0U9QXJ0aWNsZUJyb3dzZXImVFQ9ZnR4JlBhcnREZXRhaWxJRD1TRE0gMTkwMTA=
//        http://ecat.ua/Rul-ova-tyaga-SIDEM-SDM-19010/005JlJFRlBBR0U9QXJ0aWNsZUJyb3dzZXImVFQ9ZnR4JlBhcnREZXRhaWxJRD1TRE0gMTkwMTA=
//        http://ecat.ua/Rul-ova-tyaga-SIDEM-SDM-19010/005JlJFRlBBR0U9QXJ0aWNsZUJyb3dzZXImVFQ9ZnR4JlBhcnREZXRhaWxJRD1TRE0gMTkwMTA=
//        http://ecat.ua/Rul-ova-tyaga-SIDEM-SDM-19010/005JlJFRlBBR0U9QXJ0aWNsZUJyb3dzZXImVFQ9ZnR4JlBhcnREZXRhaWxJRD1TRE0gMTkwMTA=
//        "http://ecat.ua/Rul-ova-tyaga-SIDEM-SDM-19010/005JlJFRlBBR0U9QXJ0aWNsZUJyb3dzZXImVFQ9ZnR4JlBhcnREZXRhaWxJRD1TRE0gMTkwMTA="
////        var_dump($oridginal_ling);
//#ctl00_cphBody_ArticleBrowserCtl_lvParts_Item1901020801_tdActiveNumber1901020801 > a)
////        id="ctl00_cphBody_ArticleBrowserCtl_lvParts_Item1901020802_tdActiveNumber1901020802
//        #ctl00_cphBody_ArticleBrowserCtl_lvParts_
//        #ItemSDM19010_tdActiveNumberSDM19010 > a:nth-child(3)
        $result[$this->siteUrl] = array(
//            'Origin' => $links_price,
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
