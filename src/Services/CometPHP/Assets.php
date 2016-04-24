<?php

namespace Snscripts\HtmlHelper\Services\CometPHP;

class Assets implements \Snscripts\HtmlHelper\Interfaces\Assets
{
    /**
     * base function to return assets
     *
     * @param   mixed   asset path data received from the image method
     * @return  string  url to pass to img or css
     */
    protected function getAsset($assetData)
    {
        try {
            $Comet = \CometPHP\Comet::getInstance();
        } catch (\CometPHP\Exceptions\CometNotBooted $e) {
            return null;
        }

        if (! is_array($assetData)) {
            $assetData = [$assetData];
        }

        $asset = $Comet['template']->getFunction('asset')->call(
            $this->template,
            $assetData
        );

        return $asset;
    }

    /**
     * base function to return the img path for the image tag
     *
     * @param   mixed   img path data received from the image method
     * @return  string  url to pass to img.src
     */
    public function getImage($img)
    {
        return $this->getAsset($img);
    }

    /**
     * base function to return the css path for the css tag
     *
     * @param   mixed   css path data received from the css method
     * @return  string  url to pass to link.href
     */
    public function getStyle($css)
    {
        return $this->getAsset($css);
    }

    /**
     * base function to return the script path for the js script tag
     *
     * @param   mixed   js path data received from the script method
     * @return  string  url to pass to script.src
     */
    public function getScript($js)
    {
        return $this->getAsset($js);
    }
}
