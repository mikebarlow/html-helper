<?php

namespace Snscripts\HtmlHelper;

class Attributes
{
    /**
     * Render the attributes
     *
     * @param  array  $attributes
     * @return string
     */
    public function attr(array $attributes)
    {
        $result = '';

        foreach ($attributes as $attribute => $value) {
            $result .= ' '.(is_int($attribute) ? $value : $attribute.'="'.str_replace('"', '&quot;', $value).'"');
        }

        return $result;
    }

    /**
     * It will merge multiple attributes arrays without erase values
     *
     * @return array
     */
    public function mergeAttr()
    {
        $arrays = func_get_args();
        $result = array();

        foreach ($arrays as $array) {
            $result = $this->mergeRecursive($result, $array);
        }

        return $result;
    }

    /**
     * @param  array $arr1
     * @param  array $arr2
     * @return array
     */
    protected function mergeRecursive(array $arr1, array $arr2)
    {
        foreach ($arr2 as $key => $v) {
            if (is_array($v)) {
                $arr1[$key] = isset($arr1[$key]) ? $this->mergeRecursive($arr1[$key], $v) : $v;
            } else {
                $arr1[$key] = isset($arr1[$key]) ? $arr1[$key].($arr1[$key] != $v ? ' '.$v : '') : $v;
            }
        }

        return $arr1;
    }
}
