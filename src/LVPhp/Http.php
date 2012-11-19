<?php
namespace LVPhp;
class Http implements \Meetup\HttpInterface
{
    protected $buzz;
    
    public function __construct()
    {
        $this->buzz = $browser = new \Buzz\Browser(new \Buzz\Client\Curl());
    }
    
	/* (non-PHPdoc)
     * @see Meetup.HttpInterface::get()
     */
    public function get($url, $query = array()) 
    {
        $response =  $this->buzz->get($url . '?' . http_build_query($query));
        return $response->getContent();
    }
}