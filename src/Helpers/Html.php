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
    public function div($contents, $attr = null)
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
    public function p($contents, $attr = null)
    {
        return $this->tag('p', $attr, $contents, true);
    }

    /**
     * unordered list
     *
     * @param   array   Array of items to list / attr
     * @param   array   Array of attributes for the ul
     * @return  string
     */
    public function ul($list, $attr = null)
    {
        $out = $this->tag('ul', $attr);

        if (! empty($list) && is_array($list)) {
            foreach ($list as $key => $value) {
                if (is_array($value) && (isset($value['list']) || isset($value['attr']))) {
                    $attr = (isset($value['attr'])) ? $value['attr'] : null;
                    $ulAttr = (isset($value['ulAttr'])) ? $value['ulAttr'] : null;
                    $subList = (isset($value['list'])) ? $this->ul($value['list'], $ulAttr) : '';

                    $out .= $this->tag('li', $attr, $key . $subList);
                } elseif (is_array($value)) {
                    $out .= $this->tag('li', null, $key . $this->ul($value['list']));
                } else {
                    $out .= $this->tag('li', null, $value);
                }
            }
        }

        $out .= $this->tag('/ul');

        return $out;
    }
}
