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
    const SIZE_NUMERIC_MIN = 1;
    const SIZE_NUMERIC_MAX = 12;

    const SIZE_MINI = 'mini';
    const SIZE_SMALL = 'small';
    const SIZE_MEDIUM = 'medium';
    const SIZE_LARGE = 'large';
    const SIZE_XLARGE = 'xlarge';
    const SIZE_XXLARGE = 'xxlarge';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $tag = 'input';

    /**
     * @var array
     */
    protected $classes = array();

    /**
     * @var \BootstrapForm\Form
     */
    protected $parent;

    /**
     * @var array
     */
    protected $attribs = array();

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string|int
     */
    protected $size;

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
     * @param array $classes
     * @return AbstractElement
     */
    public function setClasses($classes)
    {
        foreach($classes as $class)
            $this->setClass($class);
        return $this;
    }

    /**
     * @param string $class
     * @return AbstractElement
     */
    public function setClass($class)
    {
        $this->classes[$class] = $class;
        return $this;
    }

    /**
     * @return array
     */
    public function classes()
    {
        return $this->classes;
    }

    /**
     * @param string $class
     * @return mixed
     */
    public function getClass($class)
    {
        if(isset($this->classes[$class]))
            return $this->classes[$class];
        return null;
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
     * @param int|string $size
     * @return AbstractElement
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return int|string
     */
    public function size()
    {
        return $this->size;
    }

    abstract public function render();

    /**
     * @return string
     */
    public function renderElement()
    {
        $output = '<' . $this->tag() . ' ';

        $output .= $this->renderAttribs();

        if('attrib' === $this->renderValueType)
            $output .= static::renderAttrib('value', $this->value());

        $output .= $this->renderClasses();

        $output .= '>';

        if('content' === $this->renderValueType)
            $output .= $this->value();

        if($this->renderClosingTag)
            $output .= '</' . $this->tag() . '>';

        return $output;
    }

    /**
     * @return string
     */
    public function renderClasses()
    {
        $size = $this->size();
        if($size) {
            if(is_numeric($size) && $size >= self::SIZE_NUMERIC_MIN && $size <= self::SIZE_NUMERIC_MAX) {
                $this->setClass('span' . $size);
            }
            else {
                $this->setClass('input-' . $size);
            }
        }

        $classes = $this->classes();
        if(count($classes)) {
            return static::renderAttrib('class', implode(' ', $classes)) . ' ';
        }
        return '';
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

    /**
     * @return AbstractElement
     */
    protected function rebuildId()
    {
        $parts = array();

        $name = $this->name();
        $element = $this;

        do {
            array_unshift($parts, $name);

            $element = $element->parent();
            if($element && !$element instanceof Form) {
                $name = $element->name();
            }
            else {
                $name = null;
            }
        }
        while($name);

        $this->setAttrib('id', implode('_', $parts));

        $elName = array_shift($parts);
        while(count($parts)) {
            $elName .= '[' . array_shift($parts) . ']';
        }
        $this->setAttrib('name', $elName);

        return $this;
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
