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
     * @var boolean
     */
    protected $horizontal = false;

    /**
     * @param array $options
     */
    public function __construct($options = array())
    {
        parent::__construct(null, $options);
    }

    /**
     * @param string $method
     * @return Form
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
     * @param boolean $horizontal
     * @return Form
     */
    public function setHorizontal($horizontal)
    {
        $this->horizontal = (boolean) $horizontal;
        return $this;
    }

    /**
     * @return boolean
     */
    public function horizontal()
    {
        return $this->horizontal;
    }

    /**
     * @return string
     */
    public function render()
    {
        if($this->horizontal()) {
            $this->setClass('form-horizontal');
        }

        $output = sprintf('<form action="%s" method="%s" %s>', $this->action(), $this->method(), $this->renderClasses());

        foreach($this->elements as $name => $element)
            $output .= $element->render();

        $output .= '</form>';

        return $output;
    }

}
