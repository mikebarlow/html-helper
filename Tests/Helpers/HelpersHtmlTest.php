<?php

use Snscripts\HtmlHelper\Html;
use Snscripts\HtmlHelper\Interfaces;

class HelpersHtmlTest extends \PHPUnit_Framework_TestCase
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

    public function testDivReturnsValidDivElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<div class="myClass" id="content">Div Contents</div>',
            $Html->div(
                'Div Contents',
                array(
                    'class' => 'myClass',
                    'id' => 'content'
                )
            )
        );
    }

    public function testPReturnsValidPElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<p class="intro">Paragraph Contents</p>',
            $Html->p(
                'Paragraph Contents',
                array(
                    'class' => 'intro'
                )
            )
        );
    }

    public function testUlReturnsValidUlElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<ul id="main ul"><li>this is a list item</li><li>this is a list item 2</li><li>sub-item<ul><li>will they work?</li><li>or won\'t they, who knows?</li></ul></li><li id="listID">subitem attr!<ul id="sub-list"><li>this is a sub item</li><li>this list should have attributes</li></ul></li></ul>',
            $Html->ul(
                array(
                    'this is a list item',
                    'this is a list item 2',
                    'sub-item' => array(
                        'will they work?',
                        'or won\'t they, who knows?'
                    ),
                    'subitem attr!' => array(
                        'attr' => array(
                            'id' => 'listID'
                        ),
                        'listAttr' => array(
                            'id' => 'sub-list'
                        ),
                        'list' => array(
                            'this is a sub item',
                            'this list should have attributes'
                        )
                    )
                ),
                array(
                    'id' => 'main ul'
                )
            )
        );
    }

    public function testOlReturnsValidOlElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<ol id="main ol"><li>this is a list item</li><li>this is a list item 2</li><li>sub-item<ol><li>will they work?</li><li>or won\'t they, who knows?</li></ol></li><li id="listID">subitem attr!<ol id="sub-list"><li>this is a sub item</li><li>this list should have attributes</li></ol></li></ol>',
            $Html->ol(
                array(
                    'this is a list item',
                    'this is a list item 2',
                    'sub-item' => array(
                        'will they work?',
                        'or won\'t they, who knows?'
                    ),
                    'subitem attr!' => array(
                        'attr' => array(
                            'id' => 'listID'
                        ),
                        'listAttr' => array(
                            'id' => 'sub-list'
                        ),
                        'list' => array(
                            'this is a sub item',
                            'this list should have attributes'
                        )
                    )
                ),
                array(
                    'id' => 'main ol'
                )
            )
        );
    }

    public function testListReturnsValidElements()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<li>this is a list item</li><li>this is a list item 2</li><li>sub-item<ul><li>will they work?</li><li>or won\'t they, who knows?</li></ul></li><li id="listID">subitem attr!<ul id="sub-list"><li>this is a sub item</li><li>this list should have attributes</li></ul></li>',
            $Html->processList(
                array(
                    'this is a list item',
                    'this is a list item 2',
                    'sub-item' => array(
                        'will they work?',
                        'or won\'t they, who knows?'
                    ),
                    'subitem attr!' => array(
                        'attr' => array(
                            'id' => 'listID'
                        ),
                        'listAttr' => array(
                            'id' => 'sub-list'
                        ),
                        'list' => array(
                            'this is a sub item',
                            'this list should have attributes'
                        )
                    )
                )
            )
        );
    }

    public function testLinkReturnsValidElements()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<a target="_blank" class="myClass" href="http://google.com">Google</a>',
            $Html->link(
                'Google',
                'http://google.com',
                array(
                    'target' => '_blank',
                    'class' => 'myClass'
                )
            )
        );
    }

    public function testImageReturnsValidElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<img alt="This is alt text" title="This is the title" class="logo" src="/assets/img/logo.png">',
            $Html->image(
                '/assets/img/logo.png',
                array(
                    'alt' => 'This is alt text',
                    'title' => 'This is the title',
                    'class' => 'logo'
                )
            )
        );
    }

    public function testStyleReturnsValidElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<link media="print" rel="stylesheet" type="text/css" href="/assets/css/print.css">',
            $Html->style(
                '/assets/css/print.css',
                array(
                    'media' => 'print'
                )
            )
        );
    }

    public function testScriptReturnsValidElement()
    {
        $Html = $this->getHtml();

        $this->assertSame(
            '<script src="/assets/js/site.js"></script>',
            $Html->script(
                '/assets/js/site.js'
            )
        );

    }
}
