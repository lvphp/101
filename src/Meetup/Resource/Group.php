<?php
namespace Meetup\Resource;
class Group extends \Meetup\ResourceAbstract 
{
    use JsonReflector;
    
    public function getMembers()
    {
        return $this->data['members'];
    }
    
    public function getDescription()
    {
        return strip_tags($this->data['description']);
    }
}