<?php
/**
 * Created by JetBrains PhpStorm.
 * User: piotrek
 * Date: 6/20/12
 * Time: 11:42 PM
 */

namespace BootstrapForm;

/**
 * Form Actions
 *
 * @author Piotr Rybałtowski <piotrek@rybaltowski.pl>
 */
class Actions extends Element\AbstractElement
{
    const TYPE_SUBMIT = 'submit';

    const LEVEL_PRIMARY = 'primary';

    protected $actions = array();

    public function addAction($label, $type = self::TYPE_SUBMIT, $level = self::LEVEL_PRIMARY)
    {
        $this->actions[] = array(
            'label' => $label,
            'type' => $type
        );
    }
}
