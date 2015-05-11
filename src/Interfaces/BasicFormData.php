<?php

namespace Snscripts\HtmlHelper\Interfaces;

class BasicFormData implements FormData
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

        $bits = explode('.', $name);
        $postData = $_POST;

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
