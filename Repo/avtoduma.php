<?php

namespace app\Repo;

use Yii;
use GuzzleHttp\Client;
use phpQuery;



class avtoduma extends BaseRepo {
    private $result;
    public function find($article, $brand='')
	{
            $br = $brand;
            $originals = 'Origin';
            $originalreplace = 'ReplacementOriginal';
            $replaces = 'replaceNonOriginal';
            $client = new Client();
            $res = $client->request('GET', 'http://avtoduma.ua/search?n='.$article.'&brand='.$brand.'&brands=1');
            $body = $res->getBody();
            $document = phpQuery::newDocumentHTML($body,'UTF8');
            $doc = pq($document)->find('.table-responsive');  
            $link = pq($doc)->find(':contains(Номер)');
            $original = pq($doc)->find(':contains(оригинальные замены)');
            $replace = pq($doc)->find(':contains(замена)');
            $this->product($link,$originals,$br,$article);
            $this->product($original,$originalreplace,$br,$article);
            $this->product($replace,$replaces,$br,$article);
            return $this->result;
	}
        public function product($liner,$types,$brands,$articles){
            $links = pq($liner)->find('tbody tr'); 
            foreach ($links as $link) {
                $number = trim(pq($link)->find('td:eq(0)')->text());
                $name = trim(pq($link)->find('td:eq(2)')->text());
                $brand = trim(pq($link)->find('td:eq(3)')->text());
                $region = trim(pq($link)->find('td:eq(4)')->text());
                $deliverys = trim(pq($link)->find('td:eq(5)')->text());
                $quantitys = trim(pq($link)->find('td:eq(6)')->text());
                $prices = trim(pq($link)->find('td:eq(7)')->text());
                $order_link ="<a href = http://avtoduma.ua/search?n=$articles&brand=$brands&brands=1>Заказать</a><br>";
                $this->result[$this->siteUrl][$types][] = array(                   
                    'number'=>$number,'name'=>$name,'brand'=>$brand,'region'=>$region,'delivery'=>$deliverys,'quantitys'=>$quantitys,'price'=>$prices,'order_links'=>$order_link
                ); 
            }
        }
}
