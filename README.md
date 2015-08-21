# Framework Agnostic HTML-Helper

[![Author](http://img.shields.io/badge/author-@mikebarlow-red.svg?style=flat-square)](https://twitter.com/mikebarlow)
[![Source Code](http://img.shields.io/badge/source-snscripts/html--helper-brightgreen.svg?style=flat-square)](https://github.com/snscripts/html-helper)
[![Latest Version](https://img.shields.io/github/release/snscripts/html-helper.svg?style=flat-square)](https://github.com/snscripts/html-helper/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/snscripts/html-helper/blob/master/LICENSE)
[![Build Status](https://img.shields.io/travis/snscripts/html-helper/master.svg?style=flat-square)](https://travis-ci.org/snscripts/html-helper)

## Introduction

This Html Helper is a PSR-2 Compliant Framework Agnostic helper designed for use within a template system to help with the creation of Html elements that can sometimes be a laborious job!

## Requirements

### Composer

HTML Helper requires the following:

* "php": ">=5.4.0"

And the following if you wish to run in dev mode and run tests.

* "phpunit/phpunit": "~4.0"
* "squizlabs/php_codesniffer": "~2.0"

## Installation

### Composer

Simplest installation is via composer.

	composer require snscripts/html-helper 1.*

or adding to your projects `composer.json` file.

	{
	    "require": {
	        "snscripts/html-helper": "1.*"
	    }
	}

### Setup

Setup the helper as follows:

	$Html = new \Snscripts\HtmlHelper\Html(
	    new \Snscripts\HtmlHelper\Helpers\Form(
	        new \Snscripts\HtmlHelper\Interfaces\BasicFormData
	    ),
	    new \Snscripts\HtmlHelper\Interfaces\BasicRouter,
	    new \Snscripts\HtmlHelper\Interfaces\BasicAssets
	);

The main object, is the Html object which contains the skeleton of the helper with the `tag()` method which is used to generate a html tag given a set of parameters. It also contains shortcut methods for certain html elements (For the list of available tags, see below).

The first parameter, is the Form Object which contains all the methods needed to create and populate a HTML form. The Form Object requires an instance of `\Snscripts\HtmlHelper\Interfaces\FormData` which `BasicFormData` implements.

The second and third parameters should also be instances of `\Snscripts\HtmlHelper\Interfaces\Router` and `\Snscripts\HtmlHelper\Interfaces\Assets` which `BasicRouter` and `BasicAssets` implement respectively.

### Interfaces

The interfaces provide a way of making this Html Helper Framework Agnostic. Each framework provides it's own way of getting post data / assets and routes so the interfaces provide a way for each framework to be implemented.

BasicAssets and BasicRouter simply return they that is passed to the asset method or the link method, in a Framework the Router Interface would be coded to load up it's Router and pass the data received from the link method into the router allowing the framework to return the URL.

BasicFormData simply turns a dot notation path into a POST variable and searches for data at that point and returns whatever it finds. Again, in a framework this would be coded to look possibly into the Request Object for post data.

#### Framework Examples

Coming Soon.

## Usage

Assuming we've setup the object as above, the most basic method to be called is:

    /**
     * render a tag
     *
     * @param   string      tag to render
     * @param   array       attributes for the tag
     * @param   string      contents of tag when not self closing
     * @param   bool        close the tag?
     * @return  string
     */
    public function tag($tag, $attr = null, $content = null, $close = false)

And can be called like so:

	$Html->tag('div', array('class' => 'myDiv'), 'Div Contents', true);

As the DocBlock shows, the first parameter is the tag that you wish to render.

The second parameter should be a associate array containing any attributes to be placed on the tag.

The third parameter (if required) should be the contents of the tag, this is only used if the fourth parameter is set to true to create a closing tag.

An example of a self closing tag would be:

	$Html->tag('input', array('type' => 'text', 'name' => 'my_name'));

That would generate a simple text input box.

That simple method powers the Html Helper, with all the other methods and helpers there to simply make life easier! See below for list of methods available.

## Available Methods

	// create a div tag
	$Html->div('Div Contents Here', array('class' => 'attributes'));

	// create a p tag
	$Html->p('Paragraph contents', array('id' => 'intro'));

	// create a ul list
	// See the list section for more examples
	$Html->ul(array('this', 'is', 'a', 'list'), array('data-foo' => 'bar'));

	// create an ol list
	// See the list section for more examples
	$Html->ol(array('this', 'is', 'a', 'list'), array('data-foo' => 'bar'));

	// create a hyperlink
	// The second param will be passed to RouterInterface::getUrl
	$Html->link('My Link', '/pages/about-us', array('target' => '_blank'));

	// create an image
	// the first param will be passed to AssetsInterface::getImage
	$Html->image('/assets/img/logo.png', array('alt' => 'Our Logo'));

	// create a stylesheet link
	// the first param will be passed to AssetsInterface::getStyle
	$Html->style('/assets/css/print.css', array('media' => 'print'));

	// create a script tag
	// the first param will be passed to AssetsInterface::getScript
	$Html->script('/assets/js/validate.js');

## Available Form Methods

	// Open the form
	// See form section below for more info
	$Html->Form->open('post', '/search', array('class' => 'validate'));

	// close the form
	$Html->Form->close();

	// create a label
	$Html->Form->label('My Label', array('for' => 'InputID'));

	// create an input
	// This will create full input element wrapped in a div tag with it's own label
	$Html->Form->input(
		'dot.notation.input.name',
		// translates to $_POST['dot']['notation']['input']['name']
		'Inputs Label',
		array(
			'type' => 'text',
			'class' => 'myInput'
		)
	);

	// The following simply wrap the input method above and override the 'type' attribute

	// create a hidden field
	$Html->Form->hidden('hidden.field', array('value' => 'foobar'));

	// create a password field
	$Html->Form->password('user.password', 'Your Password', array('class' => 'required'));

	// create a textarea
	$Html->Form->textarea('user.bio', 'Bio', array('cols' => 10, 'rows' => 5));

	// create a file input
	$Html->Form->file('user.cv', 'CV', array('class' => 'required'));

	// create a checkbox
	$Html->Form->checkbox(
		'read_terms',
		'Read and agree to terms',
		array('onclick' => 'someJs()')
	);

	// create a selection of radio options
	$Html->Form->radio(
		'user.plan',
		'Membership Plan',
		array(
			'plan-1' => 'PLAN 1!',
			'plan-2' => 'PLAN 2!'
		),
		array(
			'class' => 'radio-options'
		)
	);

	// Or can do the same as above with a select box
	$Html->Form->select(
		'user.plan',
		'Membership Plan',
		array(
			'plan-1' => 'PLAN 1!',
			'plan-2' => 'PLAN 2!'
		),
		array(
			'class' => 'select-box'
		)
	);

	// create a multi select box
	$Html->Form->multiselect(
		'user.plan',
		'Membership Plan',
		array(
			'plan-1' => 'PLAN 1!',
			'plan-2' => 'PLAN 2!'
		),
		array(
			'class' => 'select-all-the-plans'
		)
	);

	// create a submit button
	$Html->Form->submit('submit', 'Log Me In!', array('class' => 'btn'));

	// create a standard button
	$Html->Form->button(
		'someAction',
		'Perform Actions',
		array('class' => 'btn btn-danger')
	);

## Advanced

### Lists

The two list methods have been created in such a way that you can also define attributes for the individual `li` tags in a list and also define sub lists (and subsequently the attributes for the sub ul and sub li items!)

    echo $Html->ul(
        array(
            'this is a list item',
            'this is a list item 2',
            'sub-item' => array(
                'will they work?',
                'or won\'t they, who knows?'
            ),
            'subitem attr!' => array(
                'attr' => array(
                    'id' => 'listID'
                ),
                'ulAttr' => array(
                    'id' => 'sub-list'
                ),
                'list' => array(
                    'this is a sub item',
                    'this list should have attributes'
                )
            )
        ),
        array(
            'id' => 'main ul'
        )
    );

This will also work for `ol` lists!

### Form Open Tag

The open method can accept 3 different values for the first parameter which sets the form method. The standard `post` and `get` are 2 of the 3. The 3rd is `file`. Defining this will set the action to `post` and also define `$attr['enctype'] = 'multipart/form-data';`.

### Form Inputs

All the shortcut wrappers simply call the input method and override the `type` attribute in the attributes array. Other input types are available just by setting this type value, such as the HTML5 elements like `email`, `range` and `datetime` but no shortcut wrappers have been created.

The html structure the input method will return will be something like:

	<div class="input text">
		<label for="DataUserName">Name:</label>
		<input id="DataUserName" type="text" name="data[User][name]">
	</div>

#### Checkboxes

Checkboxes as default will return a hidden input which is placed before the actual checkbox to make sure a valid value is set if the checkbox is not checked.

	<div class="input checkbox">
		<input type="hidden" id="_DataReadterms" value="0" name="data[readterms]">
		<input type="checkbox" id="DataReadterms" name="data[readterms]" value="1">
		<label for="DataReadterms">Read the Terms?</label>
	</div>

This can be disabled by passing `hiddenCheckbox => false` as an attribute

	$Html->Form->checkbox(
		'read_terms',
		'Read and agree to terms',
		array(
			'hiddenCheckbox' => false
		)
	);

#### Select Boxes

Select box options array can accept a multi-dimensional array which will be translated into `optgroups`.

	$Html->Form->select(
		'foobar',
		'Foo-Bar:',
		array(
			'Group 1' => array(
				'1' => 'Option 1',
				'3' => 'Option 3'
			),
			'Group 2' => array(
				'2' => 'Option 2',
				'4' => 'Option 4'
			)
		)
	);

#### Wrapper Element

As default the wrapper element is a `div` with 2 or 3 classes applied. First class is always `input` second class is the input type. A 3rd class is added to multiselects types to denote it being a multiselect so it can be targeted in the CSS.

These class can be overridden as well as the tag itself (or turned off if you don't need the wrapping element).

	$Html->Form->input(
		'input_box',
		'My Input',
		array(
			'wrapper' => array(
				'tag' => 'span',
				'class' => 'wrapper-class',
				'id' => 'SpanTagId'
			)
		)
	);

	// Or turn it off with
	$Html->Form->input(
		'input_box',
		'My Input',
		array(
			'wrapper' => false
		)
	);

#### Labels

When passing a label into an input, you can either pass it as a string to simply render that string as a label, or you can pass an array to be able to define attributes on the label tag.

	$Html->Form->input(
		'input_box',
		array(
			'value' => 'My Input',
			'class' => 'label-class'
		),
		array(
			'wrapper' => false
		)
	);

#### Injects

As the methods return the full div / label / input it can be difficult or long-winded to do every method manually if you need to place text between the label and the input.

As a result, `before`, `between` and `after` injection points are available for you to use to place text / html in.

	$Html->Form->input(
		'amount',
		'Price',
		array(
			'before' => 'Enter the',
			'between' => 'you want in UK Pence',
			'after' => 'p'
		)
	);

	// would return
	<div class="input text">
		Enter the
		<label for="Amount">Price:</label>
		you want in UK Pence
		<input id="Amount" type="text" name="amount">
		p
	</div>

## Contributing

Please see [CONTRIBUTING](https://github.com/snscripts/html-helper/blob/master/CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](https://github.com/snscripts/html-helper/blob/master/LICENSE) for more information.