<?php

namespace Snscripts\HtmlHelper\Integrations;

class PlatesPhp extends \League\Plates\Extension\ExtensionInterface
{
    public $htmlHelper;

    /**
     * Register extension function.
     * @return null
     */
    public function register(Engine $engine)
    {
        $this->engine = $engine;
        $this->engine->registerFunction('html', array($this, 'getHtmlHelper'));
    }

    /**
     * Create new HtmlHelper instance.
     *
     * @param object $HtmlHelper Instance of the html helper
     */
    public function __construct($HtmlHelper)
    {
        $this->HtmlHelper = $htmlHelper;
    }

    /**
     * return the instance of the html helper
     *
     * @return object $htmlHelper Instance of the html helper
     */
    public function getHtmlHelper()
    {
        return $this->htmlHelper;
    }
}
