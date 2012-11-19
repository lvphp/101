<?php
namespace Meetup\Resource;
class Group extends \Meetup\ResourceAbstract 
{
    public function getMembers()
    {
        return $this->data['members'];
    }
    
    public function getDescription()
    {
        return strip_tags($this->data['description']);
    }
    
    public function jsonSerialize()
    {
        return array(
            'members' => $this->getMembers(),
            'description' => $this->getDescription(),
        );
    }
}