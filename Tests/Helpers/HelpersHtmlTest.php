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
            new Interfaces\AbstractRouter,
            new Interfaces\AbstractFormData,
            new Interfaces\AbstractAssets
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
                        'ulAttr' => array(
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
                        'ulAttr' => array(
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
            $Html->list(
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
                        'ulAttr' => array(
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
}