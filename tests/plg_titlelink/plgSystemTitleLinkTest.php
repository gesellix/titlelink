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

        JFactory::$application = $this->getMockCmsApp();
        JFactory::$database = $this->getMockDatabase();

        $dispatcher = JEventDispatcher::getInstance();
        JFactory::$application->loadDispatcher($dispatcher);

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

    public function test_defaultTriggerPrefix()
    {
        $this->assertThat(
            $this->_titlelink->trigger_prefix,
            $this->equalTo("{ln"));
    }

    public function test_defaultTriggerSuffix()
    {
        $this->assertThat(
            $this->_titlelink->trigger_suffix,
            $this->equalTo("}"));
    }

    public function test_onAfterRender_exists()
    {
        $this->assertThat(
            is_callable(array ($this->_titlelink, 'onAfterRender')),
            $this->isTrue());
    }

    public function test_replaceTitleLinksWithURLs_exists()
    {
        $this->assertThat(
//            is_callable(array ($this->_titlelink, 'replaceTitleLinksWithURLs')),
            TestReflection::invoke($this->_titlelink, 'replaceTitleLinksWithURLs', "content"),
            $this->equalTo("content"));
    }

    public function test_onAfterRender_in_admin_backend_returns_unchanged_body()
    {
        JFactory::$application->setBody("{ln:body}");
        $this->assignMockReturns(JFactory::$application, array ('isAdmin' => true));

        $this->_titlelink->onAfterRender();

        $this->assertThat(
            JFactory::$application->getBody(),
            $this->equalTo("{ln:body}"));
    }

    public function test_onAfterRender_in_content_edit_mode_returns_unchanged_body()
    {
        JFactory::$application->setBody("{ln:body}");
        $this->assignMockReturns(JFactory::$application, array ('isAdmin' => false));
        JFactory::$application->input->set('option', 'com_content');
        JFactory::$application->input->set('layout', 'edit');

        $this->_titlelink->onAfterRender();

        $this->assertThat(
            JFactory::$application->getBody(),
            $this->equalTo("{ln:body}"));
    }
}
