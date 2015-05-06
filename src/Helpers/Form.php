<?php

namespace Snscripts\HtmlHelper\Helpers;

class Form
{
    protected $Html;

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
}
