<?php
/**
 * Created by JetBrains PhpStorm.
 * User: piotrek
 * Date: 6/21/12
 * Time: 11:28 AM
 */

namespace BootstrapForm\Meta;

use BootstrapForm\Element\AbstractElement;

/**
 * Whitespace meta element
 *
 * @author Piotr Rybałtowski <piotrek@rybaltowski.pl>
 */
class Whitespace extends AbstractElement
{
    public function render()
    {
        return '&nbsp;';
    }
}
