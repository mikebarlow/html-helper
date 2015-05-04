<?php

namespace Snscripts\HtmlHelper;

use \Snscripts\HtmlHelper\Interfaces\Router as RouterInterface;
use \Snscripts\HtmlHelper\Interfaces\FormData as FormDataInterface;
use \Snscripts\HtmlHelper\Interfaces\Assets as AssetsInterface;

class Html
{
    protected $RouterInterface;
    protected $FormDataInterface;
    protected $AssetsInterface;

    protected $Attr;
    public $Form;

    use \Snscripts\HtmlHelper\Helpers\Html;

    /**
     * setup the helper, providing the interfaces
     * for routes/ form data and assets
     *
     * @param   Object  Instance of an RouterInterface
     * @param   Object  Instance of an FormDataInterface
     * @param   Object  Instance of an AssetsInterface
     */
    public function __construct(
        RouterInterface $Router,
        FormDataInterface $FormData,
        AssetsInterface $Assets
    ) {
        $this->setRouter($Router);
        $this->setFormData($FormData);
        $this->setAssets($Assets);

        $this->Attr = new \Snscripts\HtmlAttributes\Attributes;
        $this->Form = new \Snscripts\HtmlHelper\Helpers\Form;
    }

    /**
     * render a tag
     *
     * @param   string      tag to render
     * @param   array       attributes for the tag
     * @param   string      contents of tag when not self closing
     * @param   bool        self-close the tag?
     * @return  string
     */
    public function tag($tag, $attr = null, $content = null, $close = false)
    {
        $tag = strtolower($tag);

        if (! empty($attr) && is_array($attr)) {
            $attr = $this->Attr->attr($attr);
        }

        if ($close) {
            return sprintf('<%s%s>%s</%1$s>', $tag, $attr, $content);
        } else {
            return sprintf('<%s%s>', $tag, $attr);
        }
    }

    /**
     * check and set the router interface
     *
     * @param   Object  Instance of an RouterInterface
     * @return  bool
     * @throws  \InvalidArgumentException
     */
    public function setRouter($Router)
    {
        if (! is_object($Router) || ! $Router instanceof RouterInterface) {
            throw new \InvalidArgumentException(
                'The Router Interface must be a valid RouterInterface Object'
            );
        }
        $this->Router = $Router;

        return true;
    }

    /**
     * check and set the form data interface
     *
     * @param   Object  Instance of an FormDataInterface
     * @return  bool
     * @throws  \InvalidArgumentException
     */
    public function setFormData($FormData)
    {
        if (! is_object($FormData) || ! $FormData instanceof FormDataInterface) {
            throw new \InvalidArgumentException(
                'The FormData Interface must be a valid FormDataInterface Object'
            );
        }
        $this->FormData = $FormData;

        return true;
    }

    /**
     * check and set the Asset interface
     *
     * @param   Object  Instance of an AssetsInterface
     * @return  bool
     * @throws  \InvalidArgumentException
     */
    public function setAssets($Assets)
    {
        if (! is_object($Assets) || ! $Assets instanceof AssetsInterface) {
            throw new \InvalidArgumentException(
                'The Assets Interface must be a valid AssetsInterface Object'
            );
        }
        $this->Assets = $Assets;

        return true;
    }
}
