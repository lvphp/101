<?php

include '../src/Meetup/HttpInterface.php';
include '../src/LVPhp/Http.php';

class HttpTest extends PHPUnit_Framework_TestCase
{
  /**
   * @var LVPhp\Http
   */
  protected $http;

  protected function getMockBrowser()
  {
    $response = $this->getMock('Response', array('getContent'));
    $response->expects($this->any())
             ->method('getContent')
             ->will($this->returnValue('content'));

    $browser = $this->getMock('Browser', array('get'));
    $browser->expects($this->any())
            ->method('get')
            ->will($this->returnValue($response));

    return $browser;
  }

  public function setUp()
  {
    $this->http = new LVPhp\Http( $this->getMockBrowser() );
  }

  public function testCanSetupHttpObject()
  {
    $object = new LVPhp\Http( $this->getMockBrowser() );
    $this->assertInstanceOf( 'LVPhp\Http', $object );
  }  

  public function testCanGetAUrl()
  {
    $response = $this->http->get('http://www.example.com');
    $this->assertEquals('content', $response);
  }

  /**
   * Provide different Bad URLs
   */
  public function badUrlProvider()
  {
    return array(
      array(''),
      array(' '),
    );  
  }

  /**
   * @expectedException InvalidArgumentException
   * @dataProvider badUrlProvider
   */
  public function testWillThrowExceptionIfUrlIsEmpty($url)
  {
    $this->http->get($url); 
  }

  /**
   * Provide different types of valid queries
   */
  public function queriesProvider()
  {
      return array(
          array('param1=yes&param2=no'),
          array(array('param1' => 'yes', 'param2' => 'no')),
      );
  }

  /**
   * @dataProvider queriesProvider
   */
  public function testCanUseArraysOrStringsAsQueries($queries)
  {
    $response = $this->http->get('http://www.example.com', $queries);
    $this->assertEquals('content', $response);
  }
}
