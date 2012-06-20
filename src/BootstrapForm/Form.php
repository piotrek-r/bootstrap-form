<?php
/**
 * Created by JetBrains PhpStorm.
 * User: piotrek
 * Date: 6/20/12
 * Time: 9:08 PM
 */

namespace BootstrapForm;

/**
 * Form
 *
 * @author Piotr Rybałtowski <piotrek@rybaltowski.pl>
 */
class Form extends Fieldset
{
    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var string
     */
    protected $action ='';

    /**
     * @var array
     */
    protected $buttons = array();

    /**
     * @param array $options
     */
    public function __construct($options = array())
    {
        parent::__construct(null, $options);
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return string
     */
    public function method()
    {
        return $this->method;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return string
     */
    public function action()
    {
        return $this->action;
    }

    /**
     * @param string $label
     * @param string $type
     * @param string $level
     * @return Form
     */
    public function addButton($label, $type = 'submit', $level = 'primary')
    {
        $this->buttons[] = array(
            'label' => $label,
            'type'  => $type,
            'level' => $level,
        );
        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $output = sprintf('<form action="%s" method="%s">', $this->action(), $this->method());

        foreach($this->elements as $name => $element)
            $output .= $element->render();

        $output .= '</form>';

        return $output;
    }
}
