<?php

namespace Snscripts\HtmlHelper\Interfaces;

class BasicRouter implements Router
{
    /**
     * base function to return the url for the link method
     *
     * @param   mixed   url data received from the link method
     * @return  string  url to pass to href
     */
    public function getUrl($url)
    {
        return $url;
    }
}
