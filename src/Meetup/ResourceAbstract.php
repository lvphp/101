<?php
namespace Meetup;
abstract class ResourceAbstract
{
    protected $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
}