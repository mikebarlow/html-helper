<?php

class BasicFormDataTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $this->assertInstanceOf(
            '\Snscripts\HtmlHelper\Interfaces\BasicFormData',
            new \Snscripts\HtmlHelper\Interfaces\BasicFormData
        );
    }

    public function testGetValueReturnsNullWhenInvalidNamePassed()
    {
        $FormData = new \Snscripts\HtmlHelper\Interfaces\BasicFormData;

        $this->assertNull(
            $FormData->getValue(123)
        );

        $this->assertNull(
            $FormData->getValue([])
        );

        $this->assertNull(
            $FormData->getValue(new \stdClass)
        );
    }

    public function testGetValueReturnsCorrectDataFromPostData()
    {
        $FormData = new \Snscripts\HtmlHelper\Interfaces\BasicFormData;
        $_POST = [
            'User' => [
                'email' => 'john@example.com'
            ],
            'agreed_terms' => 'yes'
        ];

        $this->assertSame(
            'john@example.com',
            $FormData->getValue('User.email')
        );

        $this->assertSame(
            [
                'email' => 'john@example.com'
            ],
            $FormData->getValue('User')
        );

        $this->assertSame(
            'yes',
            $FormData->getValue('agreed_terms')
        );
    }
}
