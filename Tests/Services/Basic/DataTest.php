<?php

class DataTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $this->assertInstanceOf(
            '\Snscripts\HtmlHelper\Services\Basic\Data',
            new \Snscripts\HtmlHelper\Services\Basic\Data
        );
    }

    public function testGetValueReturnsNullWhenInvalidNamePassed()
    {
        $FormData = new \Snscripts\HtmlHelper\Services\Basic\Data;

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
        $FormData = new \Snscripts\HtmlHelper\Services\Basic\Data;
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
