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
        $client = new Client();
        $res = $client->request('GET', 'http://autooriginal.de/?a=&p=&search='.$article);
        $body = $res->getBody();
        $document = phpQuery::newDocumentHTML($body,'UTF8');
        $links = pq($document)->find('.results tr:eq(1)'); 
        $valid = pq($links)->find('td:eq(2)')->text();
        if(strcasecmp($article, $valid) == 0){
            foreach ($links as $link) {
                     $manufacturer = pq($link)->find('td:eq(1)').'<br>';
                     $number = pq($link)->find('td:eq(2)').'<br>';
                     $name = pq($link)->find('td:eq(3)').'<br>';
                     $price = 'Цена                 : '.pq($link)->find('td:eq(4)').'<br>';
                     $available = 'Склад            : '.pq($link)->find('td:eq(6)').'<br>';
                     $order_links = 'http://autooriginal.de/?a=&p=&search='.$article;   
             }

    		$result[$this->siteUrl] = array(
    			'Origin' => array(
                    'manufacturer'=>$manufacturer,
                    'number'=>$number,
                    'name'=>$name,
                    'price'=>$price,
                    'available'=>$available,
                    'order_links'=>$order_links
                ), 
    			'ReplacementOriginal' => array(),
    			'replaceNonOriginal' => array()
    		);
        
		return $result;
        }
	}



}

