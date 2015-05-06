<?php

use Snscripts\HtmlHelper\Html;
use Snscripts\HtmlHelper\Interfaces;

class HelpersFormTest extends \PHPUnit_Framework_TestCase
{
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

    public function testOpenReturnsValidElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<form class="avatar" enctype="multipart/form-data" method="post" action="upload.php">',
            $Html->Form->open(
                'file',
                'upload.php',
                array(
                    'class' => 'avatar'
                )
            )
        );
    }

    public function testCloseReturnsValidElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '</form>',
            $Html->Form->close()
        );
    }


}
