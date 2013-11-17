<?php

require_once TITLELINK_BASE_DIR . '/plg_titlelink/titlelink.php';

class plgSystemTitleLinkTest extends TestCase
{

    /**
     * @var JRegistry default plugin params
     */
    private $_params = null;

    /**
     * @var plgSystemTitleLink plugin under test
     */
    private $_titlelink = null;

    protected function setUp()
    {
        $this->saveFactoryState();

        JFactory::$application = $this->getMockApplication();
        JFactory::$database = $this->getMockDatabase();

        $dispatcher = JEventDispatcher::getInstance();

        $this->_params = new JRegistry;
        $config = array ();
        $config['name'] = 'TitleLink';
        $config['type'] = 'System';
        $config['params'] = $this->_params;
        $this->_params->set('plugin_dir', TITLELINK_BASE_DIR . '/plg_titlelink/titlelink_plugins');

        $this->_titlelink = new plgSystemTitleLink($dispatcher, $config);
    }

    protected function tearDown()
    {
        $this->restoreFactoryState();
    }

    public function test_defaultTriggerPrefix_with_TestReflection()
    {
        $this->assertThat(
            TestReflection::getValue($this->_titlelink, 'trigger_prefix'),
            $this->equalTo("{ln"));
    }

    public function test_defaultTriggerPrefix()
    {
        $trigger_prefix = $this->_titlelink->trigger_prefix;
        $this->assertThat($trigger_prefix, $this->equalTo("{ln"));
    }

    public function test_defaultTriggerSuffix()
    {
        $trigger_suffix = $this->_titlelink->trigger_suffix;
        $this->assertThat($trigger_suffix, $this->equalTo("}"));
    }
}
