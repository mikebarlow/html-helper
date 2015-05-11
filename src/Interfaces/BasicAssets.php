<?php

namespace Snscripts\HtmlHelper\Interfaces;

class BasicAssets implements Assets
{
    /**
     * base function to return the img path for the image tag
     *
     * @param   mixed   img path data received from the image method
     * @return  string  url to pass to img.src
     */
    public function getImage($img)
    {
        return $img;
    }

    /**
     * base function to return the css path for the css tag
     *
     * @param   mixed   css path data received from the css method
     * @return  string  url to pass to link.href
     */
    public function getStyle($css)
    {
        return $css;
    }

    /**
     * base function to return the script path for the js script tag
     *
     * @param   mixed   js path data received from the script method
     * @return  string  url to pass to script.src
     */
    public function getScript($js)
    {
        return $js;
    }
}
