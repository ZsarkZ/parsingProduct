<?php 

namespace app\Repo;

abstract class BaseRepo
{
	public $siteUrl;
	public $result;

	public function __construct($siteUrl)
    {
    	$this->siteUrl = $siteUrl;
    	$this->result = array(
            'Origin' => array(
            	$this->siteUrl => array()
            ), 
            'ReplacementOriginal' => array(
            	$this->siteUrl => array()
            ),
            'replaceNonOriginal' => array(
            	$this->siteUrl => array()
            )
        );
    }

    abstract public function find($article, $brand = '');
}
 ?> 
