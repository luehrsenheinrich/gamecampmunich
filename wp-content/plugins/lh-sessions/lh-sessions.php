<?php
/*
Plugin Name: L//H Sessions Planner
Version: 2.82
Description: The most awesome plugin for session planning and documentation for wordpress
Author: Hendrik Luehrsen
Plugin URI: http://www.luehrsen-heinrich.de
Text Domain: lh-sessions
Domain Path: /lang


Copyright 2012 Luehrsen // Heinrich Gbr

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/



require_once( dirname( __FILE__ ). "/session.core.php" );
require_once( dirname( __FILE__ ). "/session.admin.php" );
require_once( dirname( __FILE__ ). "/session.front.php" );
require_once( dirname( __FILE__ ). "/session.functions.php" );
require_once("tax-meta-class.php");


if(is_admin()){
	$lh_session = new SessionAdmin();
} else {
	$lh_session = new SesseionFrontend();	
}