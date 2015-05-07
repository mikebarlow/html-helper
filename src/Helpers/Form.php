<?php

namespace Snscripts\HtmlHelper\Helpers;

class Form
{
    protected $Html;

    /**
     * input types requiring custom tag
     * @param   array
     */
    public $nonInputTypes = array(
        'textarea',
        'select',
        'button'
    );

    /**
     * construct
     * setup the class and store the HTML object
     *
     * @param   Object  Instance of the Html Helper Object
     */
    public function __construct(\Snscripts\HtmlHelper\Html $Html)
    {
        $this->Html = $Html;
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
     * generate a field
     *
     * @param   string  The type of input field to create
     * @param   array   Array of attributes for the tag
     * @return  string
     */
    public function generateField($name, $attr = array())
    {
        $tag = 'input';

        if (empty($attr['type'])) {
            $attr['type'] = 'text';
        }

        if (in_array($attr['type'], $this->nonInputTypes)) {
            $tag = $attr['type'];
        }

        $attr['name'] = $name;

        if ($tag !== 'input') {
            $generate = 'generate' . ucfirst(strtolower($tag)) . 'Field';
            return $this->{$generate}($attr);
        } else {
            return $this->Html->tag('input', $attr);
        }
    }

    /**
     * generate a textarea
     *
     * @param   array   array of attributes
     * @return  string
     */
    public function generateTextareaField($attr)
    {
        return $this->Html->tag('textarea', $attr, '', true);
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
        unset($attr['value']);

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
        $options = array();

        if (! empty($attr['options'])) {
            $options = $attr['options'];
        }
        unset($attr['options']);
        $options = $this->generateOptions($options);

        return $this->Html->tag('select', $attr, $options, true);
    }

    /**
     * generate the options for a select box
     *
     * @param   array   array of options
     * @return  string
     */
    public function generateOptions($options)
    {
        $return = '';

        foreach ($options as $key => $value) {
            $return .= $this->Html->tag(
                'option',
                array(
                    'value' => $key
                ),
                $value,
                true
            );
        }

        return $return;
    }
}
