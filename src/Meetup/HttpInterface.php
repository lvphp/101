<?php
namespace Meetup;
interface HttpInterface
{
    public function get($url, $query = array());
}