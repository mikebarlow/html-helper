<?php

namespace Snscripts\HtmlHelper\Helpers;

use \Snscripts\HtmlHelper\Interfaces\FormData as FormDataInterface;
use \Snscripts\HtmlHelper\Html as HtmlObject;

class Form
{
    protected $FormData;
    protected $Html;

    /**
     * input types requiring custom tag
     * @param   array
     */
    public $customGenerate = array(
        'textarea',
        'select',
        'multiselect',
        'button',
        'checkbox',
        'radio'
    );

    /**
     * order formats for inputs
     */
    public $orderFormat = array(
        'checkbox' => array(
            'before', 'field', 'between', 'label', 'after'
        ),
        'default' => array(
            'before', 'label', 'between', 'field', 'after'
        )
    );

    /**
     * construct
     * setup the class and store the HTML object
     *
     * @param   Object  Instance of the Html Helper Object
     */
    public function __construct(FormDataInterface $FormData)
    {
        $this->setFormData($FormData);
    }

    /**
     * open a form
     *
     * @param   string  Type of form, get / post / file (adds as post and adds enctype) etc...
     * @param   string  Action for the form
     * @param   array   Array of extra params
     * @return  string
     */
    public function open($method, $action = '', $attr = array())
    {
        // check if they wish to send a file
        // default to post method and add the enctype needed to send files
        $method = strtolower($method);
        if ($method === 'file') {
            $method = 'post';
            $attr['enctype'] = 'multipart/form-data';
        }

        if (! in_array($method, array('post', 'get'))) {
            $method = 'post';
        }

        $attr['method'] = $method;
        $attr['action'] = $action;

        return $this->Html->tag('form', $attr);
    }

    /**
     * close the form
     *
     * @return  string
     */
    public function close()
    {
        return $this->Html->tag('/form');
    }

    /**
     * generate a label
     *
     * @param   string  Label Text
     * @param   array   Array of attributes for the label tag
     * @return  string
     */
    public function label($text, $attr = array())
    {
        return $this->Html->tag('label', $attr, $text, true);
    }

    /**
     * shortcut for hidden input field
     *
     * @param   string          input name (dot notation for multi-dimensional array)
     * @param   array           input attributes
     * @return  string
     */
    public function hidden($name, $attr = array())
    {
        return $this->input(
            $name,
            false,
            array_merge(
                $attr,
                array('type' => 'hidden', 'wrapper' => false)
            )
        );
    }

    /**
     * shortcut for password field
     *
     * @param   string          input name (dot notation for multi-dimensional array)
     * @param   string|array    Label string or array of label value and attributes
     * @param   array           input attributes
     * @return  string
     */
    public function password($name, $label, $attr = array())
    {
        return $this->input(
            $name,
            $label,
            array_merge(
                $attr,
                array('type' => 'password')
            )
        );
    }

    /**
     * shortcut for textarea field
     *
     * @param   string          input name (dot notation for multi-dimensional array)
     * @param   string|array    Label string or array of label value and attributes
     * @param   array           input attributes
     * @return  string
     */
    public function textarea($name, $label, $attr = array())
    {
        return $this->input(
            $name,
            $label,
            array_merge(
                $attr,
                array('type' => 'textarea')
            )
        );
    }

    /**
     * shortcut for file field
     *
     * @param   string          input name (dot notation for multi-dimensional array)
     * @param   string|array    Label string or array of label value and attributes
     * @param   array           input attributes
     * @return  string
     */
    public function file($name, $label, $attr = array())
    {
        return $this->input(
            $name,
            $label,
            array_merge(
                $attr,
                array('type' => 'file')
            )
        );
    }

    /**
     * shortcut for checkbox field
     *
     * @param   string          input name (dot notation for multi-dimensional array)
     * @param   string|array    Label string or array of label value and attributes
     * @param   array           input attributes
     * @return  string
     */
    public function checkbox($name, $label, $attr = array())
    {
        return $this->input(
            $name,
            $label,
            array_merge(
                $attr,
                array('type' => 'checkbox')
            )
        );
    }

    /**
     * generate a submit input
     *
     * @param   string  dot notation form for input - will match with Input handler and prefill if found
     * @param   string  label for form, pass false to not show label
     * @param   array   array of extra options for the input
     * @return  string  form element
     */
    public function submit($name, $label, $attr = array())
    {
        return $this->input(
            $name,
            false,
            array_merge(
                $attr,
                array(
                    'type' => 'submit',
                    'value' => $label
                )
            )
        );
    }

    /**
     * generate a button input
     *
     * @param   string  dot notation form for input - will match with Input handler and prefill if found
     * @param   string  label for form, pass false to not show label
     * @param   array   array of extra options for the input
     * @return  string  form element
     */
    public function button($name, $label, $attr = array())
    {
        return $this->input(
            $name,
            false,
            array_merge(
                $attr,
                array(
                    'type' => 'button',
                    'value' => $label
                )
            )
        );
    }

    /**
     * generate a select
     *
     * @param   string          input name (dot notation for multi-dimensional array)
     * @param   string|array    Label string or array of label value and attributes
     * @param   array           Select Options
     * @param   array           input attributes
     * @return  string
     */
    public function select($name, $label, $options, $attr = array())
    {
        return $this->input(
            $name,
            $label,
            array_merge(
                $attr,
                array(
                    'type' => 'select',
                    'options' => $options
                )
            )
        );
    }

    /**
     * generate a group of radio buttons
     *
     * @param   string          input name (dot notation for multi-dimensional array)
     * @param   string|array    Label string or array of label value and attributes
     * @param   array           radio Options
     * @param   array           input attributes
     * @return  string
     */
    public function radio($name, $label, $options, $attr = array())
    {
        return $this->input(
            $name,
            $label,
            array_merge(
                $attr,
                array(
                    'type' => 'radio',
                    'options' => $options
                )
            )
        );
    }

    /**
     * generate a select
     *
     * @param   string          input name (dot notation for multi-dimensional array)
     * @param   string|array    Label string or array of label value and attributes
     * @param   array           Select Options
     * @param   array           input attributes
     * @return  string
     */
    public function multiselect($name, $label, $options, $attr = array())
    {
        return $this->input(
            $name,
            $label,
            array_merge(
                $attr,
                array(
                    'type' => 'select',
                    'options' => $options,
                    'multiple'
                )
            )
        );
    }

    /**
     * generate a complete input with wrapped div and label
     *
     * @param   string          input name (dot notation for multi-dimensional array)
     * @param   string|array    Label string or array of label value and attributes
     * @param   array           input attributes
     * @return  string
     */
    public function input($name, $label, $attr = array())
    {
        // generate an id if none exists
        if (empty($attr['id'])) {
            $attr['id'] = $this->transformNameForID($name);
        }

        // build the label
        if ($label !== false) {
            $labelAttr = [];
            if (is_array($label)) {
                $labelAttr = $label;
                $label = (! empty($label['value'])) ? $label['value'] : $name;
                unset($labelAttr['value']);
            }

            $labelAttr['for'] = $attr['id'];
            $label = $this->label($label, $labelAttr);
        } else {
            $label = '';
        }

        // remove any wrapper attributes
        // these will be dealt with later
        $wrapper = array();
        if (isset($attr['wrapper'])) {
            $wrapper = $attr['wrapper'];
            unset($attr['wrapper']);
        }

        // any before / between / after set
        // $attr passed by reference
        $injects = $this->getInjects($attr);

        // generate the actual field
        if (empty($attr['type'])) {
            $attr['type'] = 'text';
        }

        $field = $this->generateField(
            $name,
            $attr
        );

        // build the contents for the wrapper
        $contents = $this->buildField($attr['type'], $label, $field, $injects);

        // check if they actually want a wrapper
        if (isset($wrapper) && $wrapper === false) {
            return $contents;
        }

        // build up the wrapper info
        // should return the tag and attributes array
        $wrapperInfo = $this->getWrapper($wrapper, $attr);

        // return the final wrapper tag with the contents
        return $this->Html->tag(
            $wrapperInfo['tag'],
            $wrapperInfo['attr'],
            $contents,
            true
        );
    }

    /**
     * build the label / field / injects
     * format slightly different for checkboxs
     *
     * @param   string  the field type
     * @param   string  label tag / empty string
     * @param   string  field tag
     * @param   array   array of the before / between / after injects
     * @return  string
     */
    public function buildField($type, $label, $field, $injects)
    {
        $format = $this->orderFormat['default'];
        if (isset($this->orderFormat[$type])) {
            $format = $this->orderFormat[$type];
        }

        $output = '';

        foreach ($format as $item) {
            if ($item == 'label') {
                $output .= $label;
            } elseif ($item == 'field') {
                $output .= $field;
            } elseif (isset($injects[$item])) {
                $output .= $injects[$item];
            }
        }

        return $output;
    }

    /**
     * generate a field
     *
     * @param   string  The type of input field to create
     * @param   array   Array of attributes for the tag
     * @return  string
     */
    public function generateField($name, $attr = array())
    {
        $tag = 'input';

        if (in_array($attr['type'], $this->customGenerate)) {
            $tag = $attr['type'];
        }
        $attr['name'] = $this->transformName($name);

        $attr = $this->getPostData($name, $attr);

        if ($tag !== 'input') {
            $generate = 'generate' . ucfirst(strtolower($tag)) . 'Field';
            return $this->{$generate}($attr);
        } else {
            return $this->Html->tag('input', $attr);
        }
    }

    /**
     * generate a selection of radio buttons
     *
     * @param   array   array of attributes
     * @return  string
     */
    public function generateRadioField($attr)
    {
        if (empty($attr['name'])) {
            return '';
        }

        $out = '';

        $options = array();
        if (! empty($attr['options'])) {
            $options = $attr['options'];
        }

        if (isset($attr['checked'])) {
            $checkedItem = $attr['checked'];
        }

        unset($attr['options'], $attr['checked']);

        foreach ($options as $value => $label) {
            $id = $attr['id'] . '_' . $value;

            $optionsAttr = array('id' => $id, 'value' => $value);
            if (isset($checkedItem) && $checkedItem == $value) {
                $optionsAttr[] = 'checked';
            }
            $input = $this->Html->tag(
                'input',
                array_merge(
                    $attr,
                    $optionsAttr
                )
            );

            $label = $this->Html->tag(
                'label',
                array('for' => $id),
                $label,
                true
            );

            $out .= $this->Html->tag(
                'div',
                array(
                    'class' => 'radio-item'
                ),
                $input . $label,
                true
            );
        }

        return $out;
    }

    /**
     * generate a checkbox
     *
     * @param   array   array of attributes
     * @return  string
     */
    public function generateCheckboxField($attr)
    {
        if (empty($attr['name'])) {
            return '';
        }

        $out = '';

        if ((isset($attr['hiddenCheckbox']) && $attr['hiddenCheckbox']) || ! isset($attr['hiddenCheckbox'])) {
            $out .= $this->input(
                $attr['name'],
                false,
                array(
                    'type' => 'hidden',
                    'wrapper' => false,
                    'id' => '_' . $attr['id'],
                    'value' => 0
                )
            );
        }
        unset($attr['hiddenCheckbox']);

        if (! isset($attr['value'])) {
            $attr['value'] = 1;
        }

        $out .= $this->Html->tag('input', $attr);
        return $out;
    }

    /**
     * generate a textarea
     *
     * @param   array   array of attributes
     * @return  string
     */
    public function generateTextareaField($attr)
    {
        if (empty($attr['name'])) {
            return '';
        }

        $contents = '';
        if (! empty($attr['value'])) {
            $contents = $attr['value'];
        }

        unset($attr['type'], $attr['value']);
        return $this->Html->tag('textarea', $attr, $contents, true);
    }

    /**
     * generate a button
     *
     * @param   array   array of attributes
     * @return  string
     */
    public function generateButtonField($attr)
    {
        $value = 'Submit';

        if (! empty($attr['value'])) {
            $value = $attr['value'];
        }
        unset($attr['value'], $attr['type']);

        return $this->Html->tag('button', $attr, $value, true);
    }

    /**
     * generate a select field
     *
     * @param   array   array of attributes
     * @return  string
     */
    public function generateSelectField($attr)
    {
        if (empty($attr['name'])) {
            return '';
        }

        $options = array();

        if (! empty($attr['options'])) {
            $options = $attr['options'];
        }
        $options = $this->generateSelectOptions($options, $attr);

        unset($attr['options'], $attr['type'], $attr['selected']);

        return $this->Html->tag('select', $attr, $options, true);
    }

    /**
     * generate a multiselect field, just wrap around select field
     *
     * @param   array   array of attributes
     * @return  string
     */
    public function generateMultiselectField($attr)
    {
        return $this->generateSelectField($attr);
    }

    /**
     * generate the options for a select box
     *
     * @param   array   array of options
     * @param   array   array of attributes
     * @return  string
     */
    public function generateSelectOptions($options, $attr)
    {
        $return = '';

        foreach ($options as $key => $value) {
            if (is_array($value)) {
                $subArray = $this->generateSelectOptions($value, $attr);

                $return .= $this->Html->tag(
                    'optgroup',
                    array(
                        'label' => $key
                    ),
                    $subArray,
                    true
                );
            } else {
                $optionsAttr = array('value' => $key);

                if (isset($attr['selected']) && $attr['selected'] == $key) {
                    $optionsAttr[] = 'selected';
                }

                $return .= $this->Html->tag(
                    'option',
                    $optionsAttr,
                    $value,
                    true
                );
            }
        }

        return $return;
    }

    /**
     * transform the dot notation name into proper name
     *
     * @param   string  Dot notation input name
     * @return  string  transformed name for input
     */
    public function transformName($name)
    {
        if (strpos($name, '.') !== false) {
            $bits = explode('.', $name, 2);
            $bits['1'] = '[' . str_replace('.', '][', $bits['1']) . ']';
            return implode('', $bits);
        } else {
            return $name;
        }
    }

    /**
     * transform the dot notation name into a name for input ID
     * if no ID was passed
     *
     * @param   string  Dot notation input name
     * @return  string  transformed name for input ID
     */
    public function transformNameForID($name)
    {
        $bits = explode('.', $name);
        array_walk(
            $bits,
            function (&$value, $key) {
                $value = ucfirst(strtolower($value));
            }
        );
        return implode('', $bits);
    }

    /**
     * get injections from the attributes
     * allows data to be entered before, between, after
     *
     * @param   array   attributes array (Passed by reference)
     * @return  array
     */
    public function getInjects(&$attr)
    {
        $inject = array(
            'before' => '',
            'between' => '',
            'after' => ''
        );

        if (! empty($attr['before'])) {
            $inject['before'] = $attr['before'];
            unset($attr['before']);
        }

        if (! empty($attr['between'])) {
            $inject['between'] = $attr['between'];
            unset($attr['between']);
        }

        if (! empty($attr['after'])) {
            $inject['after'] = $attr['after'];
            unset($attr['after']);
        }

        return $inject;
    }

    /**
     * given any user defined wrapper instructions
     * build the wrapper data
     *
     * @param   array   Array of any passed wrapper info
     * @param   array   Array of the inputs attributes
     * @return  array   two element array of tag / attr
     */
    public function getWrapper($wrapper, $attr)
    {
        $type = '';
        if (! empty($attr['type'])) {
            $type = ' ' . $attr['type'];

            if ((isset($attr['type']) && $attr['type'] == 'select') && in_array('multiple', $attr)) {
                $type .= ' multiselect';
            }
        }

        $defaults = array(
            'tag' => 'div',
            'class' => 'input' . $type
        );

        $wrapperAttr = array_merge(
            $defaults,
            $wrapper
        );

        // double check for the presence of a tag element
        $tag = $wrapperAttr['tag'];
        unset($wrapperAttr['tag']);

        return array(
            'tag' => $tag,
            'attr' => $wrapperAttr
        );
    }

    /**
     * use the FormData interface and find any post data
     *
     * @param   string          input name (dot notation for multi-dimensional array)
     * @param   array   Array of attributes for the tag
     * @return  array   Return the attribute array with added post data
     */
    public function getPostData($name, $attr)
    {
        if (empty($name)) {
            return $attr;
        }

        $value = $this->FormData->getValue($name);

        if ($value !== null) {
            $isCheckbox = (isset($attr['type']) && $attr['type'] == 'checkbox');
            $isRadio = (isset($attr['type']) && $attr['type'] == 'radio');
            $isSelect = (isset($attr['type']) && $attr['type'] == 'select');

            if ($isCheckbox) {
                $attr[] = 'checked';
            } elseif ($isRadio) {
                $attr['checked'] = $value;
            } elseif ($isSelect) {
                $attr['selected'] = $value;
            } else {
                $attr['value'] = $value;
            }
        }

        return $attr;
    }

    /**
     * check and set the form data interface
     *
     * @param   Object  Instance of an FormDataInterface
     * @return  bool
     * @throws  \InvalidArgumentException
     */
    public function setFormData($FormData)
    {
        if (! is_object($FormData) || ! $FormData instanceof FormDataInterface) {
            throw new \InvalidArgumentException(
                'The FormData Interface must be a valid FormDataInterface Object'
            );
        }
        $this->FormData = $FormData;

        return true;
    }

    /**
     * check and set the HTML Object
     *
     * @param   Object  Instance of an Html
     * @return  bool
     * @throws  \InvalidArgumentException
     */
    public function setHtml($Html)
    {
        if (! is_object($Html) || ! $Html instanceof HtmlObject) {
            throw new \InvalidArgumentException(
                'The HTML Object must be a valid HTML Object'
            );
        }
        $this->Html = $Html;

        return true;
    }
}
