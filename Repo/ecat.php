<?php
namespace app\Repo;

use Yii;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\SessionCookieJar;
use phpQuery;

class ecat extends BaseRepo
{
    private $oridgiral_prise = array();

    public function find($article, $brand = '')
    {
        $jar = new \GuzzleHttp\Cookie\CookieJar;
        $brand = 'False';
        $cookieFile = 'jar.txt';
        $lin = 'http://ecat.ua/Rul-ova-tyaga-SIDEM-SDM-19010/005JlJFRlBBR0U9QXJ0aWNsZUJyb3dzZXImVFQ9ZnR4JlBhcnREZXRhaWxJRD1TRE0gMTkwMTA=';
        $cookieJar = new FileCookieJar($cookieFile);

        $client = new Client(['cookies' => $cookieFile]);

//        $res = $client->request('GET', "http://ecat.ua/ArticleBrowser.aspx?TT=ftx&SearchPtn=" . $article . "+&EM=" . $brand . "");
        $res = $client->request('GET', $lin);
        if ($res->getStatusCode() == 200) {
            if ($res->hasHeader('content-length')) {
                $headers = $res->getHeaders();
//                $values = $res->getHeader('Set-Cookie', true);
//                foreach ($values as $value) {
//                    echo $value;
//                }
//               echo $contentLength=$res->getHeader('x-test-header');
            }
//             $res->getProtocol();        // >>> HTTP
        }
//        $body = $res->getBody(true);
//        ctl00_styleMain
//        $document = phpQuery::newDocumentHTML($body);

//         $product_a = $document->find("link[id=ctl00_styleMain]")->attr('href');
//         $r = substr($product_a, 2);
//         $links="http://ecat.ua{$r}";
//        $res_2 = $client->request('GET', $links);
//        if ($res_2->getStatusCode() == 200) {
//                $body_2 = $res_2->getBody(true);
//        }
//           echo "__doPostBack('ctl00$cphBody$ArtDetailControl$lbOENumbers','')";
        $parametrs = "__EVENTTARGET=ctl00%24cphBody%24ArtDetailControl%24lbOENumbers&__EVENTARGUMENT=&__VIEWSTATE=&__SCROLLPOSITIONX
=0&__SCROLLPOSITIONY=0&ctl00%24tbDebugHidden=11.11.2016+00%3A12%3A28%3A1629+%2F+y2g2lfsymieoru00z5tmcdmj
+%2F+e9e15cd0-7214-4c09-a1b4-6b849b8b76d6&ctl00%24cphMenu%24MenuControl%24tbSearch=%D0%98%D1%81%D0%BA
%D0%BE%D0%BC%D1%8B%D0%B9+%D0%BD%D0%BE%D0%BC%D0%B5%D1%80+%D0%BD%D0%B0%D1%87%D0%B8%D0%BD%D0%B0%D0%B5%D1
%82%D1%81%D1%8F+%D1%81&langmenu=ru-RU&ctl00%24cphSB%24SBC%24jstreeInitData=%5B%5D&ctl00%24ContentPlaceHolder1
%24LoginControl%24tbLoginUser=&ctl00%24ContentPlaceHolder1%24LoginControl%24tbLoginPass=&ctl00%24cphBody
%24ArtDetailControl%24tbQuantity=1&ctl00%24cphBody%24ArtDetailControl%24OEDeliveryListCtl%24tbOELightBoxQuantity
=1&ctl00%24cphBody%24BuyAlsoBoxCtl%24lbBuyAlsoBox311+929defpcs=1&ctl00%24cphBody%24BuyAlsoBoxCtl%24lbBuyAlsoBox713
+6106+10defpcs=1&ctl00%24cphBody%24BuyAlsoBoxCtl%24lbBuyAlsoBoxOX191Ddefpcs=1&ctl00%24cphBody%24BuyAlsoBoxCtl
%24lbBuyAlsoBox70+93+6613defpcs=1&ctl00%24cphBody%24BuyAlsoBoxCtl%24lbBuyAlsoBox0.022283defpcs=1&ctl00
%24cphBody%24BuyAlsoBoxCtl%24lbBuyAlsoBoxLX935defpcs=1&ctl00%24cphBody%24BuyAlsoBoxCtl%24lbBuyAlsoBoxSDM
+19189defpcs=1&ctl00%24cphBody%24BuyAlsoBoxCtl%24lbBuyAlsoBoxS+LO+03596defpcs=1&ctl00%24cphBody%24BuyAlsoBoxCtl
%24lbBuyAlsoBoxS+TL+MKT100defpcs=1&ctl00%24cphBody%24BuyAlsoBoxCtl%24lbBuyAlsoBoxS+LA+BR.1673defpcs=1
&ctl00%24AvaibilityOrderId=&ctl00%24AvaibilityOrderValue=&ctl00%24LoginControlM%24tbLoginUser=&ctl00
%24LoginControlM%24tbLoginPass=&__DATABASE_VIEWSTATE=474533323";
//        var_dump($headers['Set-Cookie'][1]);
//        echo '<pre>';
//        print_r($headers);
//        echo  '</pre>';

        $res2 = $client->request('POST', $lin, ['body' => $parametrs], ['headers' => [
            'Date' => 'Fri, 11 Nov 2016 03:27:38 GMT',
            'Server' => $headers['Date'][0],
            'Server' => $headers['Server'][0],
            'Cache-Control' => $headers['Cache-Control'][0],
            'Content-Type' => $headers['Content-Type'][0],
            'X-AspNet-Version' => $headers['X-AspNet-Version'][0],
            'X-Powered-By' => $headers['X-Powered-By'][0],
            'Content-Length' => $headers['Content-Length'][0],
            'Set-Cookie' => [$headers['Set-Cookie'][0],
                $headers['Set-Cookie'][1],
                $headers['Set-Cookie'][2],
                $headers['Set-Cookie'][3],
                $headers['Set-Cookie'][4],
                $headers['Set-Cookie'][5]
            ],
            'Vary' => $headers['Vary'][0]

        ]]);
        if ($res2->getStatusCode() == 200) {
            echo 1;
            $headers2 = $res2->getHeaders();
//            var_dump($headers2);
            $res3 = $client->request('GET', $lin, ['body' => $parametrs],['headers' => [
                'Date' => $headers2['Date'][0],
                'Server' => $headers2['Server'][0],
                'Cache-Control' => $headers2['Cache-Control'][0],
                'Content-Type' => $headers2['Content-Type'][0],
                'X-AspNet-Version' => $headers2['X-AspNet-Version'][0],
                'X-Powered-By' => $headers2['X-Powered-By'][0],
                'Content-Length' => $headers2['Content-Length'][0],
                'Set-Cookie' => [
                    $headers2['Set-Cookie'][0],
                    $headers2['Set-Cookie'][1]
                ],
                'Vary' => $headers2['Vary'][0]

            ]]);
            if ($res3->getStatusCode() == 200) {
                echo 2;
               echo  $body3 = $res3->getBody(true);
//var_dump($body3);die;
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
