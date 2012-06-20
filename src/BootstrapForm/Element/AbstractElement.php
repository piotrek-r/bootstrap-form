<?php
/**
 * Created by JetBrains PhpStorm.
 * User: piotrek
 * Date: 6/20/12
 * Time: 9:18 PM
 */

namespace BootstrapForm\Element;

use BootstrapForm\Form;
use BootstrapForm\Fieldset;

/**
 * Abstract Element
 *
 * @author Piotr Rybałtowski <piotrek@rybaltowski.pl>
 */
abstract class AbstractElement
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $tag = 'input';

    /**
     * @var \BootstrapForm\Form
     */
    protected $parent;

    /**
     * @var array
     */
    protected $attribs = array();

    /**
     * @var string
     */
    protected $renderValueType = 'content';

    /**
     * @var boolean
     */
    protected $renderClosingTag = true;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param string $name
     * @param array $options
     */
    public function __construct($name, $options = array())
    {
        $options['name'] = $name;

        foreach($options as $option => $value) {
            $method = 'set' . ucfirst($option);
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }

        $this->init();
    }

    /**
     * Run by constructor on form initialization.
     *
     * This method can be used in extending classes.
     *
     * @return void
     */
    public function init() {}

    /**
     * @param string $name
     * @return AbstractElement
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @param string $tag
     * @return AbstractElement
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return string
     */
    public function tag()
    {
        return $this->tag;
    }

    /**
     * @param AbstractElement $parent
     * @return AbstractElement
     */
    public function setParent(AbstractElement $parent)
    {
        $this->parent = $parent;
//        $this->rebuildId();
        return $this;
    }

    /**
     * @return \BootstrapForm\Form
     */
    public function parent()
    {
        return $this->parent;
    }

    /**
     * @param array $attribs
     * @return AbstractElement
     */
    public function setAttribs(array $attribs)
    {
        foreach($attribs as $name => $value)
            $this->setAttrib($name, $value);
        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @return AbstractElement
     */
    public function setAttrib($name, $value)
    {
        $this->attribs[$name] = $value;
        return $this;
    }

    /**
     * @param string $name
     * @return string
     */
    public function attrib($name)
    {
        if(isset($this->attribs[$name]))
            return $this->attribs[$name];
        return null;
    }

    /**
     * @param mixed $value
     * @return AbstractElement
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Default render action for form elements. Can be overridden in extending classes.
     *
     * @return string
     */
    public function render()
    {
        $output = sprintf('%s<div class="controls">%s</div>',
                        $this->renderLabel(),
                        $this->renderElement());

        return sprintf('<div class="control-group">%s</div>', $output);
    }

    /**
     * @return string
     */
    public function renderElement()
    {
        $output = '<' . $this->tag() . ' ';

        $output .= $this->renderAttribs();

        if('attrib' === $this->renderValueType)
            $output .= static::renderAttrib('value', $this->value());

        $output .= '>';

        if('content' === $this->renderValueType)
            $output .= $this->value();

        if($this->renderClosingTag)
            $output .= '</' . $this->tag() . '>';

        return $output;
    }

    /**
     * @return string
     * @todo Exchange xxx to something more useful
     */
    public function renderLabel()
    {
        return sprintf('<label for="%s" class="control-label">%s</label>', $this->name(), 'xxx');
    }

    /**
     * @return string
     */
    public function renderAttribs()
    {
        $output = '';
        foreach($this->attribs as $name => $value)
            $output .= static::renderAttrib($name, $value) . ' ';
        return $output;
    }

    /**
     * @static
     * @param string $name
     * @param string $value
     * @return string
     */
    public static function renderAttrib($name, $value)
    {
        return sprintf('%s="%s"', $name, $value);
    }

    protected function rebuildId()
    {
        $parts = array();

        $name = $this->name();
        do {
            $parts[] = $name;

            $parent = $this->parent();
            if(!$parent || $parent instanceof Form)
                break;

            $name = $parent->name();
        }
        while($name);

        $this->setAttrib('id', implode('_', $parts));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        try {
            $output = $this->render();
            if(is_string($output)) {
                return $output;
            }
            return '';
        }
        catch(\Exception $e) {
            return '';
        }
    }

}
