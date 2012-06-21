<?php

use BootstrapForm\Element\Button;

set_include_path(__DIR__ . '/../../src/' . PATH_SEPARATOR . get_include_path());

require_once 'BootstrapForm/Element/AbstractElement.php';
require_once 'BootstrapForm/Element/Element.php';
require_once 'BootstrapForm/Element/InputAbstract.php';
require_once 'BootstrapForm/Element/Button.php';

/**
 * Button test
 *
 * @author Piotr Rybałtowski <piotrek@rybaltowski.pl>
 */
class ButtonTest extends PHPUnit_Framework_TestCase
{
    // region tests

    public function testSanity()
    {
        $this->assertTrue(true);
    }

    public function testClass()
    {
        $button = $this->createButton();
        $this->assertInstanceOf('BootstrapForm\\Element\\Button', $button);
    }

    public function testRendering()
    {
        $button = $this->createButton();
        $this->assertEquals('<button type="submit" id="testButton" class="btn btn-primary" ></button>', (string)$button);
    }

    public function testRenderingLabel()
    {
        $button = $this->createButton()->setLabel('test button');
        $this->assertEquals('<button type="submit" id="testButton" class="btn btn-primary" >test button</button>', (string)$button);
    }

    public function testRenderingName()
    {
        $button = $this->createButton()->setName('testButtonChanged');
        $this->assertEquals('<button type="submit" id="testButtonChanged" class="btn btn-primary" ></button>', (string)$button);
    }

    public function testRenderingVersion()
    {
        $button = $this->createButton()->setVersion(Button::VERSION_INFO);
        $this->assertEquals('<button type="submit" id="testButton" class="btn btn-info" ></button>', (string)$button);
        $button->setVersion(Button::VERSION_WARNING);
        $this->assertEquals('<button type="submit" id="testButton" class="btn btn-warning" ></button>', (string)$button);
    }

    // endregion

    // region helpers

    private function createButton()
    {
        return new Button('testButton');
    }

    // endregion

}
