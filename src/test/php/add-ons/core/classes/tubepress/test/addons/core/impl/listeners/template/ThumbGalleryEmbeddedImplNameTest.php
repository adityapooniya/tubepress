<?php
/**
 * Copyright 2006 - 2013 TubePress LLC (http://tubepress.com)
 *
 * This file is part of TubePress (http://tubepress.com)
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

/**
 * @covers tubepress_addons_core_impl_listeners_template_ThumbGalleryEmbeddedImplName
 */
class tubepress_test_addons_core_impl_listeners_template_ThumbGalleryEmbeddedImplNameTest extends tubepress_test_TubePressUnitTest
{
    /**
     * @var tubepress_addons_core_impl_listeners_template_ThumbGalleryEmbeddedImplName
     */
    private $_sut;

    /**
     * @var ehough_mockery_mockery_MockInterface
     */
    private $_mockExecutionContext;

    public function onSetup()
    {
        $this->_sut = new tubepress_addons_core_impl_listeners_template_ThumbGalleryEmbeddedImplName();

        $this->_mockExecutionContext = $this->createMockSingletonService(tubepress_spi_context_ExecutionContext::_);
    }

    public function testAlterTemplateLongtailYouTube()
    {
        $this->_testCustomYouTube('longtail');
    }

    public function testAlterTemplateEmbedPlusYouTube()
    {
        $this->_testCustomYouTube('embedplus');
    }

    public function testAlterTemplateProviderDefault()
    {
        $this->_mockExecutionContext->shouldReceive('get')->once()->with(tubepress_api_const_options_names_Embedded::PLAYER_IMPL)->andReturn('player-impl');

        $video = new tubepress_api_video_Video();
        $video->setAttribute(tubepress_api_video_Video::ATTRIBUTE_PROVIDER_NAME, 'provider-name');

        $providerResult = new tubepress_api_video_VideoGalleryPage();
        $providerResult->setVideos(array($video));

        $mockTemplate = ehough_mockery_Mockery::mock('ehough_contemplate_api_Template');
        $mockTemplate->shouldReceive('setVariable')->once()->with(tubepress_api_const_template_Variable::EMBEDDED_IMPL_NAME, 'provider-name');

        $event = new tubepress_spi_event_EventBase($mockTemplate);
        $event->setArguments(array(

            'page' => 1,
            'videoGalleryPage' => $providerResult,
            'providerName' => 'provider-name'
        ));

        $this->_sut->onGalleryTemplate($event);

        $this->assertEquals($mockTemplate, $event->getSubject());
    }

    private function _testCustomYouTube($name)
    {
        $this->_mockExecutionContext->shouldReceive('get')->once()->with(tubepress_api_const_options_names_Embedded::PLAYER_IMPL)->andReturn($name);

        $video = new tubepress_api_video_Video();
        $video->setAttribute(tubepress_api_video_Video::ATTRIBUTE_PROVIDER_NAME, $name);

        $providerResult = new tubepress_api_video_VideoGalleryPage();
        $providerResult->setVideos(array($video));

        $mockTemplate = ehough_mockery_Mockery::mock('ehough_contemplate_api_Template');
        $mockTemplate->shouldReceive('setVariable')->once()->with(tubepress_api_const_template_Variable::EMBEDDED_IMPL_NAME, $name);

        $event = new tubepress_spi_event_EventBase($mockTemplate);
        $event->setArguments(array(

            'page' => 1,
            'videoGalleryPage' => $providerResult,
            'providerName' => 'youtube'
        ));

        $this->_sut->onGalleryTemplate($event);

        $this->assertEquals($mockTemplate, $event->getSubject());


    }
}

