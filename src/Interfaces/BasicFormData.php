<?php

namespace Snscripts\HtmlHelper\Interfaces;

class BasicFormData implements FormData
{

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
