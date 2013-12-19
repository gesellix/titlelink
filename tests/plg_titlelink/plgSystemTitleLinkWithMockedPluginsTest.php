<?php

require_once TITLELINK_BASE_DIR . '/plg_titlelink/titlelink.php';

class plgSystemTitleLinkWithMockedPluginsTest extends TestCase
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

        JFactory::$application = $this->getMockCmsApp();
        JFactory::$database = $this->getMockDatabase();

        $dispatcher = JEventDispatcher::getInstance();
        JFactory::$application->loadDispatcher($dispatcher);

        $this->_params = new JRegistry;
        $config = array ();
        $config['name'] = 'TitleLink';
        $config['type'] = 'System';
        $config['params'] = $this->_params;
        $this->_params->set('plugin_dir', TITLELINK_BASE_DIR . '/tests/plg_titlelink/titlelink_plugin_mocks');

        $this->_titlelink = new plgSystemTitleLink($dispatcher, $config);
    }

    protected function tearDown()
    {
        $this->restoreFactoryState();
    }

    public function test_loadPlugin_without_result_only()
    {
        $this->_params->set('plugin_without_result', 1);
        $pluginFunctions = $this->_titlelink->getPluginFunctions($this->_titlelink->plugin_dir, $this->_titlelink->pluginmask, $this->_params);
        $this->assertThat(
            $pluginFunctions[0],
            $this->equalTo('plugin_withoutresult'));
    }
}
