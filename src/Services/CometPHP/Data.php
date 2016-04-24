<?php

namespace Snscripts\HtmlHelper\Services\CometPHP;

class Data implements \Snscripts\HtmlHelper\Interfaces\Data
{
    /**
     * get the post data to prefill the inputs
     *
     * @param   string      dot notation format of the input name we're looking for
     * @return  mixed|null  Return value from post data or null if not found
     */
    public function getValue($name)
    {
        if (! is_string($name)) {
            return null;
        }

        try {
            $Comet = \CometPHP\Comet::getInstance();
        } catch (\CometPHP\Exceptions\CometNotBooted $e) {
            return null;
        }

        $bits = explode('.', $name);
        $postData = $Comet['request']->request->all();

        foreach ($bits as $key) {
            if (is_array($postData) && isset($postData[$key])) {
                $postData = $postData[$key];
            } else {
                return null;
            }
        }

        return $postData;
    }
}
