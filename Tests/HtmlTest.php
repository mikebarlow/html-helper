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



}
