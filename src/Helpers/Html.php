<?php

namespace Snscripts\HtmlHelper\Helpers;

trait Html
{
    /**
     * shortcut for a div
     *
     * @param   string      Contents of the div
     * @param   array       Array of attributes for the div
     * @return  string
     */
    public function div($contents, $attr)
    {
        return $this->tag('div', $attr, $contents, true);
    }

    /**
     * shortcut for a paragraph
     *
     * @param   string      Contents of the div
     * @param   array       Array of attributes for the div
     * @return  string
     */
    public function p($contents, $attr)
    {
        return $this->tag('p', $attr, $contents, true);
    }
}
