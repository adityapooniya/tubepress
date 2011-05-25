<?php

require_once dirname(__FILE__) . '/../../../../../../../../sys/classes/org/tubepress/impl/plugin/filters/gallerytemplate/VideoMeta.class.php';

class org_tubepress_impl_plugin_filters_gallerytemplate_VideoMetaTest extends TubePressUnitTest
{
	private $_sut;

	function setup()
	{
		parent::setUp();
		$this->_sut = new org_tubepress_impl_plugin_filters_gallerytemplate_VideoMeta();
	}
	
	function getMock($className)
	{
	    $mock = parent::getMock($className);

	    
	    return $mock;
	}

	function testVideoMetaAboveAndBelow()
	{
	    $fakeTemplate = $this->getMock('org_tubepress_api_template_Template');
	    $this->_sut->alter_galleryTemplate($fakeTemplate, $this->getMock('org_tubepress_api_provider_ProviderResult'), 3);
	}
	
}
