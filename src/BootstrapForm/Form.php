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
     * @param Element\Button button
     * @return Form
     */
    public function addButton(Element\Button $button)
    {
        $this->buttons[] = $button;
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
        $output = sprintf('<form action="%s" method="%s" %s>', $this->action(), $this->method(), $this->renderClasses());

        foreach($this->elements as $name => $element)
            $output .= $element->render();

        $output .= $this->renderFormActions();

        $output .= '</form>';

        return $output;
    }

    /**
     * @return string
     */
    public function renderClasses()
    {
        if($this->horizontal()) {
            $this->setClass('form-horizontal');
        }

        return parent::renderClasses();
    }

    /**
     * @return string
     */
    public function renderFormActions()
    {
        $output = '';
        if(count($this->buttons)) {
            foreach($this->buttons as $button) {
                $output .= $button;
            }
            $output = sprintf('<div class="form-actions">%s</div>', $output);
        }
        return $output;
    }


}
