<?php
namespace Meetup;
class Http implements HttpInterface
{
	/**
	 * Very simple HTTP get
     * @see Meetup.HttpInterface::get()
     */
    public function get($url, $query = array()) 
    {
        $request = $url . '?' . http_build_query($query);
        return file_get_contents($request);
    }
}