<?php

namespace Snscripts\HtmlHelper\Interfaces;

interface Data
{
    /**
     * get the post data to prefill the inputs
     *
     * @param   string      dot notation format of the input name we're looking for
     * @return  mixed|null  Return value from post data or null if not found
     */
    public function getValue($name);
}
