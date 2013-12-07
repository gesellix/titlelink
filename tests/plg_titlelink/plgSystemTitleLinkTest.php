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

    public function test_defaultSeparator()
    {
        $this->assertThat(
            $this->_titlelink->separator,
            $this->equalTo(":"));
    }

    public function test_defaultEnablenewcontent()
    {
        $this->assertThat(
            $this->_titlelink->enablenewcontent,
            $this->equalTo(0));
    }

    public function test_defaultEnablepartialmatch()
    {
        $this->assertThat(
            $this->_titlelink->enablepartialmatch,
            $this->equalTo(1));
    }

    public function test_defaultDispLink()
    {
        $this->assertThat(
            $this->_titlelink->disp_link,
            $this->equalTo(1));
    }

    public function test_defaultDispTooltip()
    {
        $this->assertThat(
            $this->_titlelink->disp_tooltip,
            $this->equalTo(1));
    }

    public function test_defaultPluginDir()
    {
        $this->assertThat(
            $this->_titlelink->plugin_dir,
            $this->equalTo(TITLELINK_BASE_DIR . '/plg_titlelink/titlelink_plugins'));
    }

    public function test_onAfterRender_exists()
    {
        $this->assertThat(
            is_callable(array ($this->_titlelink, 'onAfterRender')),
            $this->isTrue());
    }

    public function test_onAfterRender_in_admin_backend_returns_unchanged_body()
    {
        $content = "{ln:body}";
        JFactory::$application->setBody($content);
        $this->assignMockReturns(JFactory::$application, array ('isAdmin' => true));

        $this->_titlelink->onAfterRender();

        $this->assertThat(
            JFactory::$application->getBody(),
            $this->equalTo($content));
    }

    public function test_onAfterRender_in_content_edit_mode_returns_unchanged_body()
    {
        $content = "{ln:body}";
        JFactory::$application->setBody($content);
        $this->assignMockReturns(JFactory::$application, array ('isAdmin' => false));
        JFactory::$application->input->set('option', 'com_content');
        JFactory::$application->input->set('layout', 'edit');

        $this->_titlelink->onAfterRender();

        $this->assertThat(
            JFactory::$application->getBody(),
            $this->equalTo($content));
    }

    public function test_replaceTitleLinksWithURLs_exists()
    {
        $content = "a body text";
        $this->assertThat(
//            is_callable(array ($this->_titlelink, 'replaceTitleLinksWithURLs')),
            TestReflection::invoke($this->_titlelink, 'replaceTitleLinksWithURLs', $content),
            $this->equalTo($content));
    }

    public function test_replaceTitleLinksWithURLs_is_called_with_body()
    {
        // TODO extract replaceTitleLinksWithURLs to own component and make it replaceable by a mock/spy
        $content = "content";
        JFactory::$application->setBody($content);
        $this->_titlelink->onAfterRender();
        $this->assertThat(
            JFactory::$application->getBody(),
            $this->equalTo($content));
    }

    public function test_replaceTitleLinksWithURLs_result_is_returned_as_body()
    {
        // TODO extract replaceTitleLinksWithURLs to own component and make it replaceable by a mock/spy
        $content = "content";
        JFactory::$application->setBody($content);
        $this->_titlelink->onAfterRender();
        $this->assertThat(
            JFactory::$application->getBody(),
            $this->equalTo($content));
    }

    public function test_replaceTitleLinksWithURLs_without_titlelink_pattern_returns_unchanged_body()
    {
        $content = "{lntext with an incomplete pattern";
        $this->assertThat(
            TestReflection::invoke($this->_titlelink, 'replaceTitleLinksWithURLs', $content),
            $this->equalTo($content));
    }

    public function test_replaceTitleLinksWithURLs_with_external_http_link()
    {
        $content = "look at {ln:http://www.example.com/}, ma!";
        $expectedResult = 'look at <a href="http://www.example.com/" title="http://www.example.com/">http://www.example.com/</a>, ma!';
        $this->assertThat(
            TestReflection::invoke($this->_titlelink, 'replaceTitleLinksWithURLs', $content),
            $this->equalTo($expectedResult));
    }

    public function test_replaceTitleLinksWithURLs_with_external_https_link()
    {
        $content = "{ln:https://www.example.com/}";
        $expectedResult = '<a href="https://www.example.com/" title="https://www.example.com/">https://www.example.com/</a>';
        $this->assertThat(
            TestReflection::invoke($this->_titlelink, 'replaceTitleLinksWithURLs', $content),
            $this->equalTo($expectedResult));
    }

    public function test_replaceTitleLinksWithURLs_with_external_link_in_new_browser_window()
    {
        $content = "{ln:nw:http://www.example.com/}";
        $expectedResult = '<a href="http://www.example.com/" title="http://www.example.com/" target="_blank">http://www.example.com/</a>';
        $this->assertThat(
            TestReflection::invoke($this->_titlelink, 'replaceTitleLinksWithURLs', $content),
            $this->equalTo($expectedResult));
    }

    public function test_replaceTitleLinksWithURLs_with_external_link_and_individual_anchor_text()
    {
        $content = "{ln:http://www.example.com/ 'link text}";
        $expectedResult = '<a href="http://www.example.com/" title="http://www.example.com/">link text</a>';
        $this->assertThat(
            TestReflection::invoke($this->_titlelink, 'replaceTitleLinksWithURLs', $content),
            $this->equalTo($expectedResult));
    }

    public function test_replaceTitleLinksWithURLs_with_external_link_and_individual_anchor_and_title_texts()
    {
        $content = "{ln:http://www.example.com/ 'link text ''title text}";
        $expectedResult = '<a href="http://www.example.com/" title="title text">link text</a>';
        $this->assertThat(
            TestReflection::invoke($this->_titlelink, 'replaceTitleLinksWithURLs', $content),
            $this->equalTo($expectedResult));
    }

    public function test_replaceTitleLinksWithURLs_with_external_link_and_suffix()
    {
        $content = "{ln:append-SUFFIX:http://www.example.com/ 'linktext}";
        $expectedResult = '<a href="http://www.example.com/SUFFIX" title="http://www.example.com/">linktext</a>';
        $this->assertThat(
            TestReflection::invoke($this->_titlelink, 'replaceTitleLinksWithURLs', $content),
            $this->equalTo($expectedResult));
    }

    public function test_replaceTitleLinksWithURLs_with_external_link_and_link_anchor()
    {
        $content = "{ln:http://www.example.com/#ANCHOR 'linktext}";
        $expectedResult = '<a href="http://www.example.com/#ANCHOR" title="http://www.example.com/">linktext</a>';
        $this->assertThat(
            TestReflection::invoke($this->_titlelink, 'replaceTitleLinksWithURLs', $content),
            $this->equalTo($expectedResult));
    }

    public function test_replaceTitleLinksWithURLs_with_external_link_and_class()
    {
        $content = "{ln:nw:css-CLASS:http://www.example.com/ 'linktext}";
        $expectedResult = '<a href="http://www.example.com/"  class="CLASS" title="http://www.example.com/" target="_blank">linktext</a>';
        $this->assertThat(
            TestReflection::invoke($this->_titlelink, 'replaceTitleLinksWithURLs', $content),
            $this->equalTo($expectedResult));
    }

    public function test_replaceTitleLinksWithURLs_with_external_link_and_partially_disabled_plugin()
    {
        $content = "{ln:enable:false} ... {ln:http://www.non-replaced-example.com/} .. {ln:enable:true} .. {ln:http://www.example.com}";
        $expectedResult = ' ... http://www.non-replaced-example.com/ ..  .. <a href="http://www.example.com" title="http://www.example.com">http://www.example.com</a>';
        $this->assertThat(
            TestReflection::invoke($this->_titlelink, 'replaceTitleLinksWithURLs', $content),
            $this->equalTo($expectedResult));
    }
}
