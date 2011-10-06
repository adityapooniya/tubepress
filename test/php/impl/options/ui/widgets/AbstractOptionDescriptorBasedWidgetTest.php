<?php

require_once 'AbstractWidgetTest.php';

abstract class org_tubepress_impl_options_ui_widgets_AbstractOptionDescriptorBasedWidgetTest extends org_tubepress_impl_options_ui_widgets_AbstractWidgetTest {

	private $_sut;

	private $_optionDescriptor;

	public function setup()
	{
		parent::setUp();

		$ioc = org_tubepress_impl_ioc_IocContainer::getInstance();

		$this->_optionDescriptor = \Mockery::mock(org_tubepress_api_options_OptionDescriptor::_);
		$this->_optionDescriptor->shouldReceive('isApplicableToVimeo')->once()->andReturn(true);
		$this->_optionDescriptor->shouldReceive('isApplicableToYouTube')->once()->andReturn(true);

		$odr                     = $ioc->get(org_tubepress_api_options_OptionDescriptorReference::_);
		$odr->shouldReceive('findOneByName')->once()->with('name')->andReturn($this->_optionDescriptor);

		$this->_sut = $this->_buildSut('name');
	}

	protected function getSut()
	{
	    return $this->_sut;
	}

	protected function getOptionDescriptor()
	{
	    return $this->_optionDescriptor;
	}

	/**
	 * @expectedException Exception
	 */
	public function testBadOptionName()
	{
	    $ioc = org_tubepress_impl_ioc_IocContainer::getInstance();

	    $odr = $ioc->get(org_tubepress_api_options_OptionDescriptorReference::_);
		$odr->shouldReceive('findOneByName')->once()->with('name')->andReturn(null);

		$this->_sut = new org_tubepress_impl_options_ui_widgets_TextInput('name');
	}

	public function testGetInputHtml()
	{
	    $ioc          = org_tubepress_impl_ioc_IocContainer::getInstance();
	    $templateBldr = $ioc->get(org_tubepress_api_template_TemplateBuilder::_);
	    $fse          = $ioc->get(org_tubepress_api_filesystem_Explorer::_);
	    $sm           = $ioc->get(org_tubepress_api_options_StorageManager::_);

	    $template = \Mockery::mock(org_tubepress_api_template_Template::_);
	    $template->shouldReceive('setVariable')->once()->with(org_tubepress_impl_options_ui_widgets_AbstractOptionDescriptorBasedWidget::TEMPLATE_VAR_NAME, 'name');
	    $template->shouldReceive('setVariable')->once()->with(org_tubepress_impl_options_ui_widgets_AbstractOptionDescriptorBasedWidget::TEMPLATE_VAR_VALUE, '<<currentvalue>>');
        $template->shouldReceive('toString')->once()->andReturn('boogity');

	    $fse->shouldReceive('getTubePressBaseInstallationPath')->once()->andReturn('<<basepath>>');

	    $templateBldr->shouldReceive('getNewTemplateInstance')->once()->with('<<basepath>>/' . $this->getTemplatePath())->andReturn($template);

	    $sm->shouldReceive('get')->once()->with('name')->andReturn('<<currentvalue>>');

	    $this->_optionDescriptor->shouldReceive('getName')->twice()->andReturn('name');

	    $this->_performAdditionToStringTestSetup($template);

	    $this->assertEquals('boogity', $this->_sut->getHtml());
	}

	protected function _performAdditionToStringTestSetup($template)
	{
	    //override point
	}

	protected function _performAdditionGetDescriptionSetup()
	{
	    //override point
	}

	public function testProviders()
	{
        $this->assertTrue($this->_sut->getArrayOfApplicableProviderNames() === array(org_tubepress_api_provider_Provider::VIMEO, org_tubepress_api_provider_Provider::YOUTUBE));
	}

	public function testGetProOnlyNo()
	{
	    $this->_optionDescriptor->shouldReceive('isProOnly')->once()->andReturn(false);

	    $this->assertTrue($this->_sut->isProOnly() === false);
	}

	public function testGetProOnlyYes()
	{
	    $this->_optionDescriptor->shouldReceive('isProOnly')->once()->andReturn(true);

	    $this->assertTrue($this->_sut->isProOnly() === true);
	}

	public function testGetDescription()
	{
	    $this->_optionDescriptor->shouldReceive('getDescription')->once()->andReturn('some-desc');

	    $this->_performAdditionGetDescriptionSetup();

	    $this->assertTrue($this->_sut->getDescription() === '<<message: some-desc>>');
	}

	public function testGetTitle()
	{
	    $this->_optionDescriptor->shouldReceive('getLabel')->once()->andReturn('some-label');

	    $this->assertTrue($this->_sut->getTitle() === '<<message: some-label>>');
	}

	protected abstract function getTemplatePath();

	protected abstract function _buildSut($name);
}

