<?php
/**
 * Copyright 2006, 2007, 2008 Eric D. Hough (http://ehough.com)
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
 * A TubePress "player", such as lightWindow, GreyBox, popup window, etc
 */
interface TubePressPlayer
{
    const GREYBOX     = "greybox";
    const LIGHTWINDOW = "lightwindow";
    const NORMAL      = "normal";
    const POPUP       = "popup";
    const SHADOWBOX   = "shadowbox";
    const YOUTUBE     = "youtube";
    
    /**
     * Puts JS and CSS libraries in the head
     *
     * @return void
     */
    public function getHeadContents();
    
    /**
     * Tells the gallery how to play the videos
     *
     * @param TubePressVideo          $vid  The video to play
     * @param TubePressOptionsManager $tpom The TubePress options manager
     * 
     * @return string The play link attributes
     */
    public function getPlayLink(TubePressVideo $vid, TubePressOptionsManager $tpom);
        
    public function getPreGalleryHtml(TubePressVideo $vid, TubePressOptionsManager $tpom);
    
    public function setEmbeddedPlayerService(TubePressEmbeddedPlayerService $tpeps);
}
?>
