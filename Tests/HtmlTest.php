<?php

use Snscripts\HtmlHelper\Html;
use Snscripts\HtmlHelper\Interfaces;

class HtmlTest extends \PHPUnit_Framework_TestCase
{

    public function testCanCreateInstance()
    {
        $this->assertInstanceOf(
            'Snscripts\HtmlHelper\Html',
            new Html(
                new Interfaces\AbstractRouter,
                new Interfaces\AbstractFormData,
                new Interfaces\AbstractAssets
            )
        );
    }

    /**
     * return an instance of the Html Helper
     * with constructor dissabled so we can test the constructor setters
     */
    protected function getHtmlNoConstructor()
    {
        return $this->getMockBuilder('\Snscripts\HtmlHelper\Html')
            ->setMethods(array('__construct'))
            ->setConstructorArgs(array(false, false))
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testSettingValidAbstractRouter()
    {
        $Html = $this->getHtmlNoConstructor();

        $this->assertTrue(
            $Html->setRouter(
                new Interfaces\AbstractRouter
            )
        );
    }

    public function testSettingInvalidAbstractRouterThrowsException()
    {
        $this->setExpectedException('InvalidArgumentException');
        $Html = $this->getHtmlNoConstructor();

        $Html->setRouter(
            new Interfaces\AbstractFormData
        );
    }

}
