<?php

namespace Snscripts\HtmlHelper\Integrations;

use \League\Plates\Engine;

class PlatesPHP implements \League\Plates\Extension\ExtensionInterface
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
        $this->HtmlHelper = $HtmlHelper;
    }

    /**
     * return the instance of the html helper
     *
     * @return object $htmlHelper Instance of the html helper
     */
    public function getHtmlHelper()
    {
        $this->HtmlHelper->Form->getDataService()->template = $this->template;
        $this->HtmlHelper->getRouterService()->template = $this->template;
        $this->HtmlHelper->getAssetsService()->template = $this->template;
        return $this->HtmlHelper;
    }
}
