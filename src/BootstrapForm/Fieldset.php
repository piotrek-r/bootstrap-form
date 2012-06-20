<?php
/**
 * Created by JetBrains PhpStorm.
 * User: piotrek
 * Date: 6/20/12
 * Time: 9:21 PM
 */

namespace BootstrapForm;

/**
 * Form Fieldset
 *
 * @author Piotr Rybałtowski <piotrek@rybaltowski.pl>
 */
class Fieldset extends Element\AbstractElement
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $elements = array();

    /**
     * @var string
     */
    protected $legend;

    /**
     * @var Form
     */
    protected $parent;

    /**
     * @param string $legend
     * @return Fieldset
     */
    public function setLegend($legend)
    {
        $this->legend = (string) $legend;
        return $this;
    }

    /**
     * @return string
     */
    public function legend()
    {
        return $this->legend;
    }

    /**
     * @param string $name
     * @return Fieldset
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
     * @param Element\AbstractElement $element
     * @return Form
     * @throws Exception\InvalidArgumentException
     */
    public function addElement(Element\AbstractElement $element)
    {
        if(!$element instanceof Fieldset && !$element instanceof Element\AbstractElement)
            throw new Exception\InvalidArgumentException('Trying to add a form element of unknown type');

        $name = $element->name();
        if(empty($name))
            throw new Exception\InvalidArgumentException('Trying to add a form element without a name');

        $element->setParent($this);

        $this->elements[$name] = $element;

        return $this;
    }

    /**
     * @param array $elements
     * @return Form
     */
    public function setElements($elements = array())
    {
        $this->elements = array();

        foreach($elements as $element) {
            $this->add($element);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $output = '<fieldset>';

        if($this->legend()) {
            $output .= sprintf('<legend>%s</legend>', $this->legend());
        }

        foreach($this->elements as $name => $element)
            $output .= $element->render();

        $output .= '</fieldset>';

        return $output;
    }

}
