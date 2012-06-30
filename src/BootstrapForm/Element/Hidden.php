<?php
/**
 * Created by JetBrains PhpStorm.
 * User: piotrek
 * Date: 6/20/12
 * Time: 11:55 PM
 */

namespace BootstrapForm\Element;

/**
 * hidden input field
 *
 * @author Piotr Rybałtowski <piotrek@rybaltowski.pl>
 */
class Hidden extends InputAbstract
{
    /**
     * @var string
     */
    protected $type = 'hidden';

    /**
     * @var boolean
     */
    protected $renderErrors = false;

    /**
     * @var boolean
     */
    protected $skipControls = true;
}
