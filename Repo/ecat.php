<?php
namespace app\Repo;

use Yii;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\FileCookieJar;

//use GuzzleHttp\Cookie\SessionCookieJar;
//
use phpQuery;

class ecat extends BaseRepo
{
    private $orignally_product = array();
    private $replacement_product=array();
    protected $article_replacement;
//    protected $oridginal_ling;
    protected $link_replacement;
    protected $option_replacment;
    protected $cookieFile = 'jar.txt';
protected    $all_number_product= array();


    public function find_option_article($article_replacement,  $replacement_product=0)
    {
          isset($replacement_product[0]);
        $cookieJar2 = new FileCookieJar($this->cookieFile);
        $client2 = new Client(["base_uri" => "http://ecat.ua", 'cookies' => $cookieJar2]);
        $re = $client2->request('GET', "http://ecat.ua/ArticleBrowser.aspx?TT=ftx&SearchPtn=" . $article_replacement . "+&EM=");
        if ($re->getStatusCode() == 200) {

            $b2 = $re->getBody(true);
            $d = phpQuery::newDocumentHTML($b2);
            $id_td = 'ctl00_cphBody_ArticleBrowserCtl_lvParts_tblAdvancedBrowser';
            $td = $d->find(" table[id^={$id_td}] td:nth-child(2) a");
//            $ArtBrowserCtlOENumbers = $document2->find("table[id^={$table_id}] td:nth-child(2) span");

            foreach ($td as $link) {

                 $stac_replase[]=pq($link)->text();
                  pq($link)->attr('href');
            }

             $res = array_diff($stac_replase, $replacement_product);

              $table = $d->find(" table[id^={$id_td}]");
            foreach ($res as $td_replacment)
            {
                 $td_replacment;
//                echo "<br>";
                $key = str_replace(" ","",$td_replacment);
                $l2_replacment = $table->find("td[id$={$key}]")->eq(1);
                $replacment_ling = pq($l2_replacment)->find("a")->attr('href');
                $l2_replacment = $table->find("td[id$={$key}]")->eq(1);
                $number_replacment = pq($l2_replacment)->find("a")->text();
                $l1_replacment = $table->find("td[id$={$key}]")->eq(2);
                $name_replacment = pq($l1_replacment)->find("span")->text();

                $l3_replacment = $table->find("td[id$={$key}]")->eq(3);
                $supplier_replacment = pq($l3_replacment)->find("span")->text();
                $l4_replacment = $table->find("td[id$={$key}]")->eq(5);
                $available_replacment = pq($l4_replacment)->find("input")->eq(0)->val();
                $l6_replacment = $table->find("td[id$={$key}]")->eq(4);
                $price_replacment = (float)pq($l6_replacment)->find("span")->text();

                $this->option_replacment[] = ['number' => $number_replacment, 'name' => $name_replacment, 'supplier' => $supplier_replacment, 'available' => $available_replacment, 'order_links' => $replacment_ling, 'price' => $price_replacment];
            }

        }
        return $this->option_replacment;
    }

    public function find($article, $brand = '')
    {
        $jar = new \GuzzleHttp\Cookie\CookieJar;
        $brand = 'False';
        $cookieFile = 'jar.txt';
        $cookieJar = new FileCookieJar($cookieFile);
//        $cookieJar = new SessionCookieJar('SESSION_STORAGE', true);
        $client = new Client(["base_uri" => "http://ecat.ua", 'cookies' => $cookieJar]);

        $res0 = $client->request('GET', "http://ecat.ua/ArticleBrowser.aspx?TT=ftx&SearchPtn=" . $article . "+&EM=");
        if ($res0->getStatusCode() == 200) {
            $body0 = $res0->getBody(true);
            $document0 = phpQuery::newDocumentHTML($body0);
//            $idadd = 'ctl00_cphBody_ArtDetailControl_ArtBrowserCtlOENumbers';
            $idadd = 'ctl00_cphBody_ArticleBrowserCtl_lvParts_Item';
            $links = $document0->find(" td[id^={$idadd}]>a");
            foreach ($links as $link) {
//              echo  pq($link)->text() . '<br>';die;
//          echo  $name_link = pq($link)->text();
//            $result1[][1] = preg_match_all($this->shablone, $name_link, $resul);
//            if ($resul) {
//                echo pq($link)->attr('href');
//            }
                $name_product2 = pq($link)->text();
                $aray_name_produrct = explode(" ", $name_product2);
//            var_dump($aray_name_produrct);
                foreach ($aray_name_produrct as $poduct) {
//                var_dump($poduct);

                    if ($poduct === $article) {
//                    var_dump($poduct);
                        $tr_oridginal = $idadd . $poduct;

                        $oridginal_ling = pq($link)->attr('href');
                        $l2 = $document0->find("td[id$={$poduct}]")->eq(1);
                        $number = pq($l2)->find("a")->text();
                        $l1 = $document0->find("td[id$={$poduct}]")->eq(2);
                        $name = pq($l1)->find("span")->text();

                        $l3 = $document0->find("td[id$={$poduct}]")->eq(3);
                        $supplier = pq($l3)->find("a")->eq(0)->text();
                        $l4 = $document0->find("td[id$={$poduct}]")->eq(5);
                        $available = pq($l4)->find("input")->eq(0)->val();
                        $l6 = $document0->find("td[id$={$poduct}]")->eq(4);
                        $price = (float)pq($l6)->find("span")->text();
                        $this->orignally_product = ['number' => $number, 'name' => $name, 'supplier' => $supplier, 'available' => $available, 'order_links' => $oridginal_ling, 'price' => $price];
//                        var_dump($this->orignally_product);
                    }
                }
//            var_dump($result1);
//            $result1[]=preg_match("/".$article."/",$name_link);
//                var_dump($result1);
//            if ($result1) {
//                echo "Вхождение найдено.";
//                echo pq($link)->attr('href').'<br>';
//            echo pq($link);
//            } else {
//                echo "Вхождение не найдено.";
//            }
//            echo pq($link);
//            var_dump($link);
//            preg_match();
            }
//         echo  $l = $document0->find("tr[id^={$idadd}]>a");
//            echo "<pre>";
////            print_r($l);
//            echo "</pre>";
//


        }

        $res = $client->request('GET', $this->orignally_product['order_links']);
        if ($res->getStatusCode() == 200) {
            if ($res->hasHeader('content-length')) {
                $values = $res->getHeader('Set-Cookie', true);
                $body = $res->getBody(true);
                $document = phpQuery::newDocumentHTML($body);
                $n = 'ctl00$tbDebugHidden';
                $product_a = $document->find("input[name=__DATABASE_VIEWSTATE]")->val();
                $product_b = $document->find("input[name={$n}]")->val();
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
        $parametrs = ['__DATABASE_VIEWSTATE' => $product_a,
            '__EVENTTARGET' => 'ctl00$cphBody$ArtDetailControl$lbOENumbers',
            'ctl00$cphBody$ArtDetailControl$ArtBrowserCtlOENumbers$OEDeliveryListCtl$tbOELightBoxQuantity' => '1',
            'ctl00$cphBody$ArtDetailControl$ArtBrowserCtlOENumbers$rbsTemplate' => '1',
            'ctl00$cphBody$ArtDetailControl$ArtBrowserCtlOENumbers$scrollLeft' => '0',
            'ctl00$cphBody$ArtDetailControl$ArtBrowserCtlOENumbers$scrollTop' => '0',
            'ctl00$cphBody$ArtDetailControl$OEDeliveryListCtl$tbOELightBoxQuantity' => '1',
            'ctl00$cphBody$BuyAlsoBoxCtl$lbBuyAlsoBox0.022283defpcs' => '1',
            'ctl00$cphBody$BuyAlsoBoxCtl$lbBuyAlsoBox311 929defpcs' => '1',
            'ctl00$cphBody$BuyAlsoBoxCtl$lbBuyAlsoBox70 93 6613defpcs' => '1',
            'ctl00$cphBody$BuyAlsoBoxCtl$lbBuyAlsoBox713 6106 10defpcs' => '1',
            'ctl00$cphBody$BuyAlsoBoxCtl$lbBuyAlsoBoxLX935defpcs' => '1',
            'ctl00$cphBody$BuyAlsoBoxCtl$lbBuyAlsoBoxOX191Ddefpcs' => '1',
            'ctl00$cphBody$BuyAlsoBoxCtl$lbBuyAlsoBoxS LA BR.1673defpcs' => '1',
            'ctl00$cphBody$BuyAlsoBoxCtl$lbBuyAlsoBoxS LO 03596defpcs' => '1',
            'ctl00$cphBody$BuyAlsoBoxCtl$lbBuyAlsoBoxS TL MKT100defpcs' => '1',
            'ctl00$cphBody$BuyAlsoBoxCtl$lbBuyAlsoBoxSDM 19189defpcs' => '1',
            'ctl00$cphMenu$MenuControl$tbSearch' => 'Искомый номер начинается с',
            'ctl00$cphSB$SBC$jstreeInitData' => [],
            'ctl00$tbDebugHidden' => $product_b,
            'langmenu' => 'ru-RU'
        ];
//        var_dump($headers['Set-Cookie'][1]);
//        echo '<pre>';
//        print_r($headers);
//        echo  '</pre>';

        $res2 = $client->request('POST', $this->orignally_product['order_links'], ['form_params' => $parametrs]);
        if ($res2->getStatusCode() == 200) {
            echo 1;
//           echo   $headers2 = $res2->getHeaders('Set-Cookie', true);
            $body2 = $res2->getBody(true);
            $document2 = phpQuery::newDocumentHTML($body2);
//            ctl00_cphBody_ArtDetailControl_ArtBrowserCtlOENumbers_lvParts_ItemFTR5054_tdActiveNumberFTR5054
//            ctl00_cphBody_ArtDetailControl_ArtBrowserCtlOENumbers_lvParts_Item915835_tdActiveNumber915835
            $table_id = "ctl00_cphBody_ArtDetailControl_ArtBrowserCtlOENumbers_lvParts_";
            $image_id = "";

            $stack_brand = array();
            $ArtBrowserCtlOENumbers = $document2->find("table[id^={$table_id}] td:nth-child(2) span");
//            $ArtBrowserCtlOENumbers = $document2->find("td[id^={$idadd}>span]");
//            echo '<pre>';
//            print_r($ArtBrowserCtlOENumbers);die;
//            echo '</pre>';
//            id="ctl00_cphBody_ArtDetailControl_ArtBrowserCtlOENumbers_lvParts_Item92-90189_TTDIV9c537bbc-40fe-43ba-8cdb-878ff6cc6839"

            foreach ($ArtBrowserCtlOENumbers as $el) {
//                $pq = pq($el);
                if (pq($el)->text()) {
                    $stack_brand[] = pq($el)->eq(-0)->text();
                }
            }
//            var_dump($stack_brand);
            $all_number_product= array();
            foreach ($stack_brand as $stack_brand_key) {
                if (isset($this->replacement_product)&&$stack_brand_key) {
                    foreach ($this->replacement_product as $number) {
                        $this->all_number_product[] = $number['number'];
                    }
                    $this->all_number_product[] = $this->orignally_product['number'];
//                var_dump($this->all_number_product);
                } elseif(isset($stack_brand_key)) {
                    $this->all_number_product[] = $this->orignally_product['number'];
                }
                $th = $this->find_option_article($stack_brand_key, $this->all_number_product);
//            var_dump($th);
                $this->replacement_product = array_merge($this->replacement_product, $th);

            }
            $result4444= array_unique($this->all_number_product);
             print_r($result4444);
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
//            'Origin' => $orignally_product,
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
