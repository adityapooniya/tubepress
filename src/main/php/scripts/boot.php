<?php
/**
 * Copyright 2006 - 2013 TubePress LLC (http://tubepress.org)
 *
 * This file is part of TubePress (http://tubepress.org)
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

if (! function_exists('bootTubePress')) {

    /**
     * Primary bootstrapping for TubePress.
     */
    function bootTubePress()
    {
        /**
         * First, record the root path.
         */
        if (!defined('TUBEPRESS_ROOT')) {

            define('TUBEPRESS_ROOT', realpath(dirname(__FILE__) . '/../../../../'));
        }

        /**
         * Second, we add our classloader.
         */
        if (! class_exists('ehough_pulsar_ComposerClassLoader')) {

            require_once TUBEPRESS_ROOT . '/vendor/ehough/pulsar/src/main/php/ehough/pulsar/ComposerClassLoader.php';
        }
        $loader = new ehough_pulsar_ComposerClassLoader(TUBEPRESS_ROOT . '/vendor/');
        $loader->register();

        /*
         * Finally, hand off control to the TubePress bootstrapper. This will
         *
         * 1. Setup logging.
         * 2. Build and compile the core IOC container.
         * 3. Load system add-ons
         * 4. Load user add-ons
         */
        require TUBEPRESS_ROOT . '/src/main/php/classes/tubepress/impl/bootstrap/TubePressBootstrapper.php';
        $bootStrapper = new tubepress_impl_bootstrap_TubePressBootstrapper();
        $bootStrapper->boot($loader);

        define('TUBEPRESS_BOOT_COMPLETE', true);
    }
}

/*
 * Don't boot twice.
 */
if (!defined('TUBEPRESS_BOOT_COMPLETE')) {

    bootTubePress();
}
