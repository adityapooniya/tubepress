<?php
require_once dirname(__FILE__) . '/../../../../includes/TubePressUnitTest.php';
require_once 'WidgetControlsTemplateTest.php';

class org_tubepress_impl_template_templates_wordpress_WordPressTemplateTestSuite
{
	public static function suite()
	{
		return new TubePressUnitTestSuite(array(

            'org_tubepress_impl_template_templates_wordpress_WidgetControlsTemplateTest'
       	));
	}
}

