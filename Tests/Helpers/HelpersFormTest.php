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

    public function testTransformNameReturnsCorrectlyFormattedInputName()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            'data[User][email]',
            $Html->Form->transformName('data.User.email')
        );

        $this->assertSame(
            'data[email]',
            $Html->Form->transformName('data.email')
        );

        $this->assertSame(
            'email',
            $Html->Form->transformName('email')
        );
    }

    public function testTransformNameForIDReturnsCorrectlyFormattedID()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            'DataUserEmail',
            $Html->Form->transformNameForID('data.User.email')
        );

        $this->assertSame(
            'DataEmail',
            $Html->Form->transformNameForID('data.email')
        );

        $this->assertSame(
            'Email',
            $Html->Form->transformNameForID('email')
        );
    }

    public function testGetInjectsCorrectlyGetsTheValuesFromArray()
    {
        $Html = $this->getHtml();

        $attr = array(
            'type' => 'text',
            'before' => '&pound;',
            'class' => 'amount',
            'after' => 'pence'
        );

        $this->assertSame(
            array(
                'before' => '&pound;',
                'between' => '',
                'after' => 'pence'
            ),
            $Html->Form->getInjects($attr)
        );

        // get injects should remove elements from the array, check it does
        $this->assertSame(
            array(
                'type' => 'text',
                'class' => 'amount'
            ),
            $attr
        );
    }

    public function testGetWrapperReturnsCorrectArray()
    {
        $Html = $this->getHtml();

        $attr = array(
            'type' => 'text',
            'before' => '&pound;',
            'class' => 'amount',
            'after' => 'pence'
        );

        $this->assertSame(
            array(
                'tag' => 'div',
                'attr' => array(
                    'class' => 'input text'
                )
            ),
            $Html->Form->getWrapper(array(), $attr)
        );

        $this->assertSame(
            array(
                'tag' => 'span',
                'attr' => array(
                    'class' => 'customClass',
                    'id' => 'divId'
                )
            ),
            $Html->Form->getWrapper(
                array(
                    'tag' => 'span',
                    'class' => 'customClass',
                    'id' => 'divId'
                ),
                $attr
            )
        );
    }

    public function testInputReturnsValidInputWithLabelAndWrapper()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<div class="input text" id="YourName"><label for="DataUserName">Your Name</label><input class="required" id="DataUserName" type="text" name="data[User][name]"><span>Enter Full Name</span></div>',
            $Html->Form->input(
                'data.User.name',
                'Your Name',
                array(
                    'wrapper' => array(
                        'id' => 'YourName'
                    ),
                    'class' => 'required',
                    'after' => '<span>Enter Full Name</span>'
                )
            )
        );
    }

    public function testInputCanTurnOffLabels()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<div class="input text" id="YourName"><input class="required" id="DataUserName" type="text" name="data[User][name]"><span>Enter Full Name</span></div>',
            $Html->Form->input(
                'data.User.name',
                false,
                array(
                    'wrapper' => array(
                        'id' => 'YourName'
                    ),
                    'class' => 'required',
                    'after' => '<span>Enter Full Name</span>'
                )
            )
        );
    }

    public function testInputCanTurnOffWrappers()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<label for="DataUserName">Your Name</label><input class="required" id="DataUserName" type="text" name="data[User][name]"><span>Enter Full Name</span>',
            $Html->Form->input(
                'data.User.name',
                'Your Name',
                array(
                    'wrapper' => false,
                    'class' => 'required',
                    'after' => '<span>Enter Full Name</span>'
                )
            )
        );
    }
}
