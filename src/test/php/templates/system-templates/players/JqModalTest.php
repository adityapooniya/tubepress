<?php
/**
 * Copyright 2006 - 2012 Eric D. Hough (http://ehough.com)
 *
 * This file is part of TubePress (http://tubepress.org)
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */
class tubepress_resources_templates_JqModalTemplateTest extends TubePressUnitTest
{
    function testTemplate()
    {
        $this->expectOutputString('hello!!!');

        ${tubepress_api_const_template_Variable::EMBEDDED_SOURCE} = 'hello!!!';

        include TUBEPRESS_ROOT . '/src/main/resources/default-themes/default/players/jqmodal.tpl.php';
    }
}
