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

    public function testLabelReturnsValidElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<label for="dataYourEmail">Your Email</label>',
            $Html->Form->label(
                'Your Email',
                array(
                    'for' => 'dataYourEmail'
                )
            )
        );
    }

    public function testGenerateFieldReturnsValidInputElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<input type="text" class="required" name="your_name">',
            $Html->Form->generateField(
                'your_name',
                array(
                    'type' => 'text',
                    'class' => 'required'
                )
            )
        );
    }

    public function testGenerateOptionsReturnsValidSelectOptions()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<option value="test1">Test One</option><option value="test2">Test Two</option>',
            $Html->Form->generateOptions(
                array(
                    'test1' => 'Test One',
                    'test2' => 'Test Two'
                )
            )
        );
    }

    public function testGenerateTextareaFieldReturnsValidTextarea()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<textarea cols="10" rows="5" name="message"></textarea>',
            $Html->Form->generateTextareaField(
                array(
                    'cols' => '10',
                    'rows' => '5',
                    'name' => 'message'
                )
            )
        );
    }

    public function testGenerateButtonFieldReturnsValidButton()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<button class="btn" name="submit">Submit Message</button>',
            $Html->Form->generateButtonField(
                array(
                    'class' => 'btn',
                    'name' => 'submit',
                    'value' => 'Submit Message'
                )
            )
        );
    }

    public function testGenerateSelectFieldReturnsValidSelect()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<select class="title" name="title"><option value="mr">Mr</option><option value="mrs">Mrs</option></select>',
            $Html->Form->generateSelectField(
                array(
                    'class' => 'title',
                    'name' => 'title',
                    'options' => array(
                        'mr' => 'Mr',
                        'mrs' => 'Mrs'
                    )
                )
            )
        );
    }
}
