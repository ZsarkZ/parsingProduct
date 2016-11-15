<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\Repo;
use Yii;
use GuzzleHttp\Client;
use phpQuery;

class autooriginal extends BaseRepo {
   public function find($article, $brand = '')
	{
            $result;
            $client = new Client();
            $res = $client->request('GET', 'http://autooriginal.de/?a=&p=&search='.$article);
            $body = $res->getBody();
            $document = phpQuery::newDocumentHTML($body,'UTF8');
            $links = pq($document)->find('.results tr:eq(1)'); 
            $valid = pq($links)->find('td:eq(2)')->text();
            if(strcasecmp($article, $valid) == 0){
                foreach ($links as $link) {
                    $manufacturer = pq($link)->find('td:eq(1)')->text();
                    $number = pq($link)->find('td:eq(2)')->text();
                    $name = pq($link)->find('td:eq(3)')->text();
                    $price = pq($link)->find('td:eq(4)')->text();
                    $available = pq($link)->find('td:eq(6)')->text();
                    $order_links = '<a href = http://autooriginal.de/?a=&p=&search='.$article.'>Корзина</a>';                   
                    $result[$this->siteUrl]['Origin'][] = array(
                        'manufacturer'=>$manufacturer,
                        'number'=>$number,
                        'name'=>$name,
                        'price'=>$price,
                        'available'=>$available,
                        'order_links'=>$order_links
                    );
                }
		return $result;
            }
	}



}

