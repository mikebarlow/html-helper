<?php

use Snscripts\HtmlHelper\Html;
use Snscripts\HtmlHelper\Interfaces;
use Snscripts\HtmlHelper\Helpers;

class HelpersFormTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $this->assertInstanceOf(
            'Snscripts\HtmlHelper\Helpers\Form',
            new Helpers\Form(
                new Interfaces\BasicFormData
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
            new Helpers\Form(
                new Interfaces\BasicFormData
            ),
            new Interfaces\BasicRouter,
            new Interfaces\BasicAssets
        );
    }

    /**
     * return an instance of the Html Helper
     * with constructor dissabled so we can test the constructor setters
     */
    protected function getFormNoConstructor()
    {
        return $this->getMockBuilder('\Snscripts\HtmlHelper\Helpers\Form')
            ->setMethods(array('__construct'))
            ->setConstructorArgs(array(false, false))
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testSettingValidAbstractFormData()
    {
        $Form = $this->getFormNoConstructor();

        $this->assertTrue(
            $Form->setFormData(
                new Interfaces\BasicFormData
            )
        );
    }

    public function testSettingInvalidAbstractFormDataThrowsException()
    {
        $this->setExpectedException('InvalidArgumentException');
        $Form = $this->getFormNoConstructor();

        $Form->setFormData(
            new \stdClass
        );
    }

    public function testSettingInvalidHtmlObjectsThrowsException()
    {
        $this->setExpectedException('InvalidArgumentException');
        $Form = $this->getFormNoConstructor();

        $Form->setHtml(
            new \stdClass
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
            $Html->Form->generateSelectOptions(
                array(
                    'test1' => 'Test One',
                    'test2' => 'Test Two'
                ),
                array() // input attributes to checked for selected option
            )
        );

        $this->assertSame(
            '<option value="test1">Test One</option><option value="test2">Test Two</option><optgroup label="OptGrp1"><option value="subtest1">Sub Test 1</option><option value="subtest2">Sub Test 2</option></optgroup>',
            $Html->Form->generateSelectOptions(
                array(
                    'test1' => 'Test One',
                    'test2' => 'Test Two',
                    'OptGrp1' => array(
                        'subtest1' => 'Sub Test 1',
                        'subtest2' => 'Sub Test 2'
                    ),
                ),
                array() // input attributes to checked for selected option
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

    public function testGenerateCheckboxFieldReturnsValidCheckbox()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<input type="hidden" id="_Readterms" value="0" name="readterms"><input type="checkbox" id="Readterms" name="readterms" value="1">',
            $Html->Form->generateCheckboxField(
                array(
                    'type' => "checkbox",
                    'id' => 'Readterms',
                    'name' => 'readterms',
                    'value' => '1',
                    'hiddenCheckbox' => true
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

        $attr = array(
            'type' => 'text',
            'before' => '&pound;',
            'class' => 'amount',
            'between' => '.',
            'after' => 'pence'
        );
        $this->assertSame(
            array(
                'before' => '&pound;',
                'between' => '.',
                'after' => 'pence'
            ),
            $Html->Form->getInjects($attr)
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

    public function testBuildFieldReturnsItemsInCorrectOrder()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            'prepended text<label for="dataYourEmail">Your Email</label>between text<input type="text" class="required" name="your_email">appended text',
            $Html->Form->buildField(
                'text',
                '<label for="dataYourEmail">Your Email</label>',
                '<input type="text" class="required" name="your_email">',
                array(
                    'before' => 'prepended text',
                    'between' => 'between text',
                    'after' => 'appended text'
                )
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

    public function testInputReturnsValidCheckbox()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<div class="input checkbox"><input type="hidden" id="_DataReadterms" value="0" name="data[readterms]"><input type="checkbox" id="DataReadterms" name="data[readterms]" value="1"><label for="DataReadterms">Read Terms</label></div>',
            $Html->Form->input(
                'data.readterms',
                'Read Terms',
                array(
                    'type' => 'checkbox'
                )
            )
        );
    }

    public function testGetPostDataReturnsValidAttrArrayWithData()
    {
        $Html = $this->getHtml();

        $_POST = array(
            'User' => array(
                'email' => 'john@example.com',
                'plan' => 'advanced'
            ),
            'terms' => 1
        );

        $this->assertSame(
            array(
                'name' => 'User[email]',
                'type' => 'text',
                'class' => 'required',
                'value' => 'john@example.com'
            ),
            $Html->Form->getPostData('User.email', array('name' => 'User[email]', 'type' => 'text', 'class' => 'required'))
        );

        $this->assertSame(
            array(
                'name' => 'terms',
                'type' => 'checkbox',
                'checked'
            ),
            $Html->Form->getPostData('terms', array('name' => 'terms', 'type' => 'checkbox'))
        );

        $this->assertSame(
            array(
                'name' => 'User[plan]',
                'type' => 'select',
                'selected' => 'advanced'
            ),
            $Html->Form->getPostData('User.plan', array('name' => 'User[plan]', 'type' => 'select'))
        );
    }

    public function testGetPostDataReturnsSameArrayWithNoNameSetOrNotDataFound()
    {
        $Html = $this->getHtml();

        $_POST = array(
            'User' => array(
                'my_email' => 'john@example.com',
                'plan' => 'advanced'
            ),
            'terms' => 1
        );

        $this->assertSame(
            array(
                'name' => 'User[email]',
                'type' => 'text',
                'class' => 'required'
            ),
            $Html->Form->getPostData(null, array('name' => 'User[email]', 'type' => 'text', 'class' => 'required'))
        );

        $this->assertSame(
            array(
                'name' => 'User[email]',
                'type' => 'text',
                'class' => 'required'
            ),
            $Html->Form->getPostData('User.email', array('name' => 'User[email]', 'type' => 'text', 'class' => 'required'))
        );
    }

    public function testHiddenReturnsValidHiddenInputElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<input value="22" type="hidden" id="DataUserId" name="data[User][id]">',
            $Html->Form->hidden('data.User.id', array('value' => 22))
        );
    }

    public function testTextareaReturnsValidTextareaElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<div class="input textarea"><label for="DataUserBio">Bio</label><textarea cols="10" rows="5" id="DataUserBio" name="data[User][bio]"></textarea></div>',
            $Html->Form->textarea(
                'data.User.bio',
                'Bio',
                array(
                    'cols' => 10,
                    'rows' => 5
                )
            )
        );
    }

    public function testFileReturnsValidFileElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<div class="input file"><label for="DataUserCv">CV</label><input type="file" id="DataUserCv" name="data[User][cv]"></div>',
            $Html->Form->file(
                'data.User.cv',
                'CV'
            )
        );
    }

    public function testSubmitReturnsValidSubmitElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<div class="input submit"><input type="submit" value="Login" id="Submit" name="submit"></div>',
            $Html->Form->submit(
                'submit',
                'Login'
            )
        );
    }

    public function testButtonReturnsValidButtonElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<div class="input button"><button id="Submit" name="submit">Login</button></div>',
            $Html->Form->button(
                'submit',
                'Login'
            )
        );
    }

    public function testSelectReturnsValidSelectElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<div class="input select"><label for="DataUserTitle">Title</label><select class="title" id="DataUserTitle" name="data[User][title]"><option value="mr">Mr</option><option value="mrs">Mrs</option></select></div>',
            $Html->Form->select(
                'data.User.title',
                'Title',
                array(
                    'mr' => 'Mr',
                    'mrs' => 'Mrs'
                ),
                array(
                    'class' => 'title'
                )
            )
        );

        $_POST['data']['User']['title'] = 'mrs';

        $this->assertSame(
            '<div class="input select"><label for="DataUserTitle">Title</label><select class="title" id="DataUserTitle" name="data[User][title]"><option value="mr">Mr</option><option value="mrs" selected>Mrs</option></select></div>',
            $Html->Form->select(
                'data.User.title',
                'Title',
                array(
                    'mr' => 'Mr',
                    'mrs' => 'Mrs'
                ),
                array(
                    'class' => 'title'
                )
            )
        );
    }

    public function testMultiSelectReturnsValidSelectElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<div class="input select multiselect"><label for="DataUserTitle">Title</label><select class="title" multiple id="DataUserTitle" name="data[User][title]"><option value="mr">Mr</option><option value="mrs">Mrs</option></select></div>',
            $Html->Form->multiselect(
                'data.User.title',
                'Title',
                array(
                    'mr' => 'Mr',
                    'mrs' => 'Mrs'
                ),
                array(
                    'class' => 'title'
                )
            )
        );
    }

    public function testPasswordReturnsValidPasswordElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<div class="input password"><label for="DataUserPass">Password:</label><input type="password" id="DataUserPass" name="data[User][pass]"></div>',
            $Html->Form->password(
                'data.User.pass',
                'Password:'
            )
        );
    }

    public function testCheckboxReturnsValidCheckboxElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<div class="input checkbox"><input type="hidden" id="_DataUserReadterms" value="0" name="data[User][readterms]"><input type="checkbox" id="DataUserReadterms" name="data[User][readterms]" value="1"><label for="DataUserReadterms">I have read and agree to the terms</label></div>',
            $Html->Form->checkbox(
                'data.User.readterms',
                'I have read and agree to the terms'
            )
        );
    }

    public function testRadioReturnsValidRadioElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<div class="input radio"><label for="DataUserPlan">Membership Plan</label><div class="radio-item"><input type="radio" id="DataUserPlan_basic" name="data[User][plan]" value="basic"><label for="DataUserPlan_basic">Basic Plan</label></div><div class="radio-item"><input type="radio" id="DataUserPlan_midlevel" name="data[User][plan]" value="midlevel"><label for="DataUserPlan_midlevel">Intermediate</label></div><div class="radio-item"><input type="radio" id="DataUserPlan_advanced" name="data[User][plan]" value="advanced"><label for="DataUserPlan_advanced">Advanced Plan!</label></div></div>',
            $Html->Form->radio(
                'data.User.plan',
                'Membership Plan',
                array(
                    'basic' => 'Basic Plan',
                    'midlevel' => 'Intermediate',
                    'advanced' => 'Advanced Plan!'
                )
            )
        );
    }
}
