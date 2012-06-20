<?php
/**
 * Created by JetBrains PhpStorm.
 * User: piotrek
 * Date: 6/21/12
 * Time: 12:00 AM
 */

namespace BootstrapForm\Element;

/**
 * InputAbstract.php
 *
 * @author Piotr Rybałtowski <piotrek@rybaltowski.pl>
 */
abstract class InputAbstract extends AbstractElement
{
    /**
     * @var string
     */
    protected $type = 'text';

    /**
     * @var string
     */
    protected $renderValueType = 'attrib';

    /**
     * @var boolean
     */
    protected $renderClosingTag = false;

    /**
     * @param string $type
     * @return InputAbstract
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->type;
    }
}
