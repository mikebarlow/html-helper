<?php

class AttributesTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Snscripts\HtmlAttributes\Attributes */
    protected $attributes;

    public function __construct()
    {
        $this->attributes = new \Snscripts\HtmlHelper\Attributes();
    }

    public function testMerging()
    {
        $arr1     = ['class' => 'main'];
        $arr2     = ['class' => 'content'];
        $expected = ['class' => 'main content'];

        $result   = $this->attributes->mergeAttr($arr1, $arr2);

        $this->assertSame($expected, $result);
    }

    public function testRendering()
    {
        $attr     = ['class' => 'main content'];
        $expected = ' class="main content"';

        $result = $this->attributes->attr($attr);

        $this->assertSame($expected, $result);
    }
}
