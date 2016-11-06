<?php 

namespace app\Repo;

abstract class BaseRepo
{
	public $siteUrl;

	public function __construct($siteUrl)
    {
    	$this->siteUrl = $siteUrl;
    }

    abstract public function find($article, $brand = '');
}
 ?> 
