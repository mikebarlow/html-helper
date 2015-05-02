<?php

namespace Snscripts\HtmlHelper;

use \Snscripts\HtmlHelper\Interfaces\AbstractRouter;
use \Snscripts\HtmlHelper\Interfaces\AbstractFormData;
use \Snscripts\HtmlHelper\Interfaces\AbstractAssets;

class Html
{
    protected $RouterInterface;
    protected $FormDataInterface;
    protected $AssetsInterface;

    /**
     * setup the helper, providing the interfaces
     * for routes/ form data and assets
     *
     * @param   Object  Instance of an AbstractRouter
     * @param   Object  Instance of an AbstractFormData
     * @param   Object  Instance of an AbstractAssets
     */
    public function __construct(
        AbstractRouter $Router,
        AbstractFormData $FormData,
        AbstractAssets $Assets
    ) {
        $this->setRouter($Router);
        $this->setFormData($FormData);
        $this->setAssets($Assets);
    }


    /**
     * parse an array of attributes into a string
     * to be added to a tag
     *
     * @param   array   Array of attributes
     * @return  string  String to add to the tag
     */
    public function convertAttributes($attr)
    {



    }





    /**
     * check and set the router interface
     *
     * @param   Object  Instance of an AbstractRouter
     * @return  bool
     * @throws  \InvalidArgumentException
     */
    public function setRouter($Router)
    {
        if (! is_object($Router) || ! $Router instanceof AbstractRouter) {
            throw new \InvalidArgumentException(
                'The Router Interface must be a valid AbstractRouter Object'
            );
        }
        $this->Router = $Router;

        return true;
    }

    /**
     * check and set the form data interface
     *
     * @param   Object  Instance of an AbstractFormData
     * @return  bool
     * @throws  \InvalidArgumentException
     */
    public function setFormData($FormData)
    {
        if (! is_object($FormData) || ! $FormData instanceof AbstractFormData) {
            throw new \InvalidArgumentException(
                'The FormData Interface must be a valid AbstractFormData Object'
            );
        }
        $this->FormData = $FormData;

        return true;
    }

    /**
     * check and set the Asset interface
     *
     * @param   Object  Instance of an AbstractAssets
     * @return  bool
     * @throws  \InvalidArgumentException
     */
    public function setAssets($Assets)
    {
        if (! is_object($Assets) || ! $Assets instanceof AbstractAssets) {
            throw new \InvalidArgumentException(
                'The Assets Interface must be a valid AbstractAssets Object'
            );
        }
        $this->Assets = $Assets;

        return true;
    }
}
