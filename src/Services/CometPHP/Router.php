<?php

namespace Snscripts\HtmlHelper\Services\CometPHP;

class Router implements \Snscripts\HtmlHelper\Interfaces\Router
{
    /**
     * base function to return the url for the link method
     *
     * @param   mixed   url data received from the link method
     * @return  string  url to pass to href
     */
    public function getUrl($url)
    {
        if (is_array($url) && ! empty($url['route'])) {
            try {
                $Comet = \CometPHP\Comet::getInstance();
            } catch (\CometPHP\Exceptions\CometNotBooted $e) {
                return null;
            }

            $routeName = $url['route'];
            unset($url['route']);

            $generatedUrl = $Comet['routeGenerator']->generate(
                $routeName,
                $url
            );

            return $generatedUrl;
        }

        return $url;
    }
}
