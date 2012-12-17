<?php
namespace LVPhp;

class Http implements \Meetup\HttpInterface
{
    protected $buzz;
    
    public function __construct( $browser = null )
    {
      $this->buzz = $browser = isset($browser) ? 
          $browser : $this->getBuzz();
    }
    
    /* (non-PHPdoc)
     * @see Meetup.HttpInterface::get()
     */
    public function get($url, $query = array()) 
    {
        $url = trim($url);

        if (empty($url) || !is_scalar($url))
        {
            throw new \InvalidArgumentException("Missing URL");
        }

        $queryParams = is_array($query) 
          ? http_build_query($query) : $query;

        $response =  $this->buzz->get($url . '?' . $queryParams);
        return $response->getContent();
    }

    /**
     * @codeCoverageIgnore
     */
    protected function getBuzz()
    {
        return new \Buzz\Browser(new \Buzz\Client\Curl());
    }
}
