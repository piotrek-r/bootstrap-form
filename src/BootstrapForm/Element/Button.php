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
     * @param string $name
     * @param array|string $options This can also be a value (text) of the button
     */
    function __construct($name, $options = array())
    {
        if(is_string($options))
            $options = array('label' => $options);
        parent::__construct($name, $options);
    }

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

    public function renderHelperPre()
    {
        return $this->label();
    }

    public function render()
    {
        return parent::render();
    }

    /**
     * @return AbstractElement|Button
     */
    protected function rebuildId()
    {
        parent::rebuildId();

        $value = $this->value();
        if(empty($value))
            unset($this->attribs['name']);

        return $this;
    }


    public function renderClasses()
    {
        $this->setClass('btn');
        $this->setClass('btn-' . $this->version());

        return parent::renderClasses();
    }
}
