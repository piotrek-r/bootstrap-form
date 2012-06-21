<?php
/**
 * Created by JetBrains PhpStorm.
 * User: piotrek
 * Date: 6/21/12
 * Time: 8:53 AM
 */

namespace BootstrapForm\Element;

/**
 * Form element
 *
 * @author Piotr Rybałtowski <piotrek@rybaltowski.pl>
 */
class Element extends AbstractElement
{
    /**
     * @var string
     */
    protected $renderValueType = 'content';

    /**
     * @var boolean
     */
    protected $renderClosingTag = true;

    /**
     * @var boolean
     */
    protected $skipControls = false;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var boolean
     */
    protected $required = true;

    /**
     * @var boolean
     */
    protected $renderErrors = true;

    /**
     * @var string
     */
    protected $helpBlock;

    /**
     * @param boolean $skipControls
     * @return Element
     */
    public function setSkipControls($skipControls)
    {
        $this->skipControls = (boolean) $skipControls;
        return $this;
    }

    /**
     * @return boolean
     */
    public function skipControls()
    {
        return $this->skipControls;
    }

    /**
     * @param string $label
     * @return Element
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function label()
    {
        return $this->label;
    }

    /**
     * @param boolean $required
     * @return Element
     */
    public function setRequired($required)
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @return boolean
     */
    public function required()
    {
        return $this->required;
    }

    /**
     * @param string $helpBlock
     * @return Element
     */
    public function setHelpBlock($helpBlock)
    {
        $this->helpBlock = (string) $helpBlock;
        return $this;
    }

    /**
     * @return string
     */
    public function helpBlock()
    {
        return $this->helpBlock;
    }


    /**
     * @return string
     */
    public function render()
    {
        $this->rebuildId();

        $output = '';

        $subClass = '';
        if($this->renderErrors && $this->hasErrors()) {
            $subClass = ' error';
            $this->setHelpBlock('@todo ERRORS');
        }

        if($this->skipControls) {
            $output .= $this->renderElement();
        }
        else {
            if($this->label())
                $output .= $this->renderLabel();

            $output .= sprintf('<div class="controls">%s%s</div>', $this->renderElement(), $this->renderHelpBlock());

            $output = sprintf('<div class="control-group%s">%s</div>', $subClass, $output);
        }

        return $output;
    }

    /**
     * @return string
     */
    public function renderHelpBlock()
    {
        if(!$this->helpBlock())
            return '';
        return sprintf('<p class="help-block">%s</p>', $this->helpBlock());
    }

    /**
     * @return string
     */
    public function renderLabel()
    {
        return sprintf('<label for="%s" class="control-label">%s</label>', $this->attrib('id'), $this->label());
    }

}
