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
     * @return string
     */
    public function render()
    {
        $this->rebuildId();

        $output = '';

        if($this->skipControls) {
            $output .= $this->renderElement();
        }
        else {
            if($this->label())
                $output .= $this->renderLabel();

            $output .= sprintf('<div class="controls">%s</div>', $this->renderElement());

            $output = sprintf('<div class="control-group">%s</div>', $output);
        }

        return $output;
    }

    /**
     * @return string
     */
    public function renderLabel()
    {
        return sprintf('<label for="%s" class="control-label">%s</label>', $this->attrib('id'), $this->label());
    }
}
