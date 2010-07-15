<?php
/**
 * Copyright 2006 - 2010 Eric D. Hough (http://ehough.com)
 * 
 * This file is part of TubePress (http://tubepress.org)
 * 
 * TubePress is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * TubePress is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with TubePress.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * Logger
 */
class org_tubepress_log_Log
{
    private static $_birthDate;
    private static $_enabled = false;

    /**
     * Print a logging statement.
     *
     * @return void
     */
    public static function log()
    {
        if (self::$_enabled) {
            $numArgs = func_num_args();
            $prefix  = func_get_arg(0);
            $message = func_get_arg(1);

            /* how many milliseconds have elapsed? */
            $time = (microtime(true) - self::$_birthDate) * 1000;

            if ($numArgs > 2) {
                $args    = func_get_args();
                $message = vsprintf($message, array_slice($args, 2, count($args)));
            }

            /* print it! */
            printf("%s ms > (%s) > %s (memory used: %s)<br /><br />", $time, $prefix, $message, number_format(memory_get_usage()));
        }
    }

    /**
     * Conditionally enables the log.
     *
     * @param boolean $enabled Whether or not to enable the log.
     * @param array   $getVars The PHP $_GET array.
     *
     * @return void
     */
    public static function setEnabled($enabled, $getVars)
    {
        self::$_enabled = $enabled && isset($getVars['tubepress_debug']) && $getVars['tubepress_debug'] == 'true';

        if (self::$_enabled) {
            self::$_birthDate = microtime(true);
        }
    }
}
