<?php

use BootstrapForm\Element\Text;

set_include_path(__DIR__ . '/../../src/' . PATH_SEPARATOR . get_include_path());

require_once 'BootstrapForm/Element/AbstractElement.php';
require_once 'BootstrapForm/Element/Element.php';
require_once 'BootstrapForm/Element/InputAbstract.php';
require_once 'BootstrapForm/Element/Text.php';

/**
 * Text input class
 *
 * @author Piotr Rybałtowski <piotrek@rybaltowski.pl>
 */
class TextTest extends PHPUnit_Framework_TestCase
{
    // region tests

    public function testSanity()
    {
        $this->assertTrue(true);
    }

    public function testConstructor()
    {
        $text = $this->createText();
        $this->assertInstanceOf('BootstrapForm\\Element\\Text', $text);
    }

    // region rendering tests

    public function testRendering()
    {
        $text = $this->createText();
        $this->assertEquals('<div class="control-group"><div class="controls">'
                        . '<input type="text" id="testText" name="testText" value=""></div></div>', (string)$text);
    }

    public function testRenderingLabel()
    {
        $testLabel = 'Test Text';
        $assertedOutput = '<div class="control-group">'
            . '<label for="testText" class="control-label">Test Text</label>'
            . '<div class="controls"><input type="text" id="testText" name="testText" value=""></div></div>';
        $text = $this->createText(array('label' => $testLabel));
        $this->assertEquals($assertedOutput, (string)$text);
        $text = $this->createText();
        $text->setLabel($testLabel);
        $this->assertEquals($assertedOutput, (string)$text);
    }

    // endregion

    // endregion

    // region helpers

    private function createText($options = array())
    {
        return new Text('testText', $options);
    }

    // endregion
}
