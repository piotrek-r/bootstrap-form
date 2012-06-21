<?php
/**
 * Created by JetBrains PhpStorm.
 * User: piotrek
 * Date: 6/21/12
 * Time: 8:04 AM
 */

namespace BootstrapForm\Element;

/**
 * Password input field
 *
 * @author Piotr Rybałtowski <piotrek@rybaltowski.pl>
 */
class Password extends Text
{
    /**
     * @var string
     */
    protected $type = 'password';

    /**
     * @var string
     */
    protected $renderValueType = 'none';
}