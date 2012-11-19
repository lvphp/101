<?php
namespace Meetup;

class Service
{
    const API_ENDPOINT = 'https://api.meetup.com/2/';
    const API_GROUPS = 'groups';
    
    protected $key;
    protected $defaults = array();
    protected $http;
    
    public function __construct($key)
    {
        $this->key = $key;
        $this->defaults['key'] = $this->key;
    }
    
    /**
     * Get an array of group data from Meetup.
     * @param string $group
     * @return array
     */
    public function getGroup($group)
    {
        //quey the api
        $result = $this->makeRequest(self::API_ENDPOINT . self::API_GROUPS, array('group_id' => $group));
        //check for the expected result
        if(!isset($result['results'][0])){
            throw new \Exception('bad response from API');
        }
        
        //return the data
        return $result['results'][0];
    }
    
    /**
     * Make HTTP Request and Check Data
     * 
     * @param string $url
     * @param array $params
     */
    protected function makeRequest($url, $params = array())
    {
        //set defaults
        $params = array_merge($this->defaults, $params);
        $body = $this->getHttpClient()->get($url, $params);
        //parse and return an array
        return json_decode($body, true);
    }
    
    public function setHttpClient(HttpInterface $http)
    {
        $this->http = $http;
    }
    
    public function getHttpClient()
    {
        if(empty($this->http)){
            $this->setHttpClient(new Http());
        }
        return $this->http;
    }
}