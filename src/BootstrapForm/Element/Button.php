<?php
/**
 * Created by JetBrains PhpStorm.
 * User: piotrek
 * Date: 6/21/12
 * Time: 8:57 AM
 */

namespace BootstrapForm\Element;

/**
 * Button element
 *
 * @author Piotr Rybałtowski <piotrek@rybaltowski.pl>
 */
class Button extends InputAbstract
{
    /**
     * @var string
     */
    protected $tag = 'button';

    /**
     * @var string
     */
    protected $type = 'submit';

    /**
     * @var string
     */
    protected $version = 'primary';

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
    protected $skipControls = true;

    /**
     * @param string $version
     * @return Button
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    public function version()
    {
        return $this->version;
    }

    public function render()
    {
        return parent::render();
    }

    public function renderClasses()
    {
        $this->setClass('btn');
        $this->setClass('btn-' . $this->version());

        return parent::renderClasses();
    }
}
