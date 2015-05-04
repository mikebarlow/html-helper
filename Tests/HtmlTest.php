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
                new Interfaces\BasicRouter,
                new Interfaces\BasicFormData,
                new Interfaces\BasicAssets
            )
        );
    }

    /**
     * return an instance of the Html Helper
     * with constructor
     */
    protected function getHtml()
    {
        return new Html(
            new Interfaces\BasicRouter,
            new Interfaces\BasicFormData,
            new Interfaces\BasicAssets
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
                new Interfaces\BasicRouter
            )
        );
    }

    public function testSettingInvalidAbstractRouterThrowsException()
    {
        $this->setExpectedException('InvalidArgumentException');
        $Html = $this->getHtmlNoConstructor();

        $Html->setRouter(
            new \stdClass
        );
    }


    public function testSettingValidAbstractFormData()
    {
        $Html = $this->getHtmlNoConstructor();

        $this->assertTrue(
            $Html->setFormData(
                new Interfaces\BasicFormData
            )
        );
    }

    public function testSettingInvalidAbstractFormDataThrowsException()
    {
        $this->setExpectedException('InvalidArgumentException');
        $Html = $this->getHtmlNoConstructor();

        $Html->setFormData(
            new \stdClass
        );
    }

    public function testSettingValidAbstractAssets()
    {
        $Html = $this->getHtmlNoConstructor();

        $this->assertTrue(
            $Html->setAssets(
                new Interfaces\BasicAssets
            )
        );
    }

    public function testSettingInvalidAbstractAssetsThrowsException()
    {
        $this->setExpectedException('InvalidArgumentException');
        $Html = $this->getHtmlNoConstructor();

        $Html->setAssets(
            new \stdClass
        );
    }

    public function testTagReturnsValidDivTagWithAttributes()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<div class="myClass" id="content">Div Contents</div>',
            $Html->tag(
                'div',
                array(
                    'class' => 'myClass',
                    'id' => 'content'
                ),
                'Div Contents',
                true
            )
        );
    }
}
