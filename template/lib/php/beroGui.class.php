<?php

Class beroGUIv2 {

	private $_page_title;

	function __construct ($page_title) {
		$this->_page_title = ((!empty($page_title)) ? $page_title : 'default');
	}

	private function _html_header ($menu, $module_name) {

		if (!empty($menu)) {
			foreach ($menu as $item) {
				if ($item['id'] == $module_name) {
					$headline2 = ' / ' . $item['title'];
					break;
				}
			}
		}

		$ret =	"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1 Transitional//EN\"\n" .
			"\t\"http://www.w3.org/TR/xhtml11/DTD/xhtml11-transitional.dtd\">\n" .
			"<html>\n" .
			"\t<head>\n" .
			"\t\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n" .
			"\t\t<title>beroNet Gateway (" . $this->_page_title . ")</title>\n" .
			"\t\t<link rel=\"icon\" type=\"image/x-icon\" href=\"/userapp/asterisk/img/favicon.ico\" />\n" .
			"\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/userapp/asterisk/css/screen.css\" />\n" .
			"\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/userapp/asterisk/css/template_css.css\" />\n" .
			"\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/userapp/asterisk/css/jquery-ui-1.8.21.custom.css\" />\n" .
			"\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/userapp/asterisk/css/jqueryslidemenu.css\" />\n" .
			"\t\t<script type=\"text/javascript\" language=\"javascript\" src=\"/userapp/asterisk/js/jquery-1.7.2.min.js\"></script>\n" .
			"\t\t<script type=\"text/javascript\" language=\"javascript\" src=\"/userapp/asterisk/js/jquery-ui-1.8.21.custom.min.js\"></script>\n" .
			"\t\t<script type=\"text/javascript\" language=\"javascript\" src=\"/userapp/asterisk/js/jqueryslidemenu.js\"></script>\n" .
			"\t</head>\n" .
			"\t<body>\n" .
			"\t\t<div class=\"container\" id=\"page\">\n" .
			"\t\t\t<div id=\"header\">\n" .
			"\t\t\t\t<div id=\"logo\" style=\"margin-bottom: 30px;\">\n" .
			"\t\t\t\t\t<a href=\"http://www.beronet.com/\" target=\"_blank\">\n" .
			"\t\t\t\t\t\t<img src=\"/userapp/asterisk/img/beroNet.jpg\" alt=\"beroNet\" class=\"png\" />\n" .
			"\t\t\t\t\t</a>\n" .
			"\t\t\t\t</div>\n" .
			$this->_html_menu($menu) .
			"\t\t\t</div>\n" .
			"\t\t\t<div id=\"pageName\" class=\"clear\">\n" .
			"\t\t\t\t<div class=\"part1\">\n" .
			"\t\t\t\t\t<h1>" . $this->_page_title . $headline2 . "</h1>\n" .
			"\t\t\t\t</div>\n" .
			"\t\t\t</div>\n" .
			"\n<!-- END FUNCTION _HTML_HEADER //-->\n\n";

		return($ret);
	}

	private function _html_menu ($menu) {

		$submenu[] = array('title' => 'App Management', 'id' => 'app_management', 'url' => '/userapp/');
		$submenu[] = array('title' => 'App Market', 'id' => 'app_market', 'url' => '/app/berogui/index.php?m=market');
		$submenu[] = array('title' => 'beroGui', 'id' => 'berogui', 'url' => '/app/berogui/');
		$submenu[] = array('title' => 'Logout', 'id' => 'logout', 'url' => '/app/berogui/includes/logout.php');
		$menu[] = array('title' => 'Management', 'id' => 'management', 'url' => '', 'submenu' => $submenu);

		$ret =	"\n<!-- BEGIN FUNCTION _HTML_MENU //-->\n\n" .
			"\t\t\t\t<div id=\"myslidemenu\" class=\"jqueryslidemenu\">\n" .
			"\t\t\t\t\t<ul id=\"navigation\">\n";

		foreach ($menu as $menuitem) {

			$ret .= "\t\t\t\t\t\t<li style=\"white-space: nowrap;\">\n";

			if (empty($menuitem['submenu'])) {
				$ret .=	"\t\t\t\t\t\t\t<a href=\"" . $menuitem['url'] . "\" id=\"" . $menuitem['id'] . "\">" . $menuitem['title'] . "</a>\n";
			} else {
				$ret .=	"\t\t\t\t\t\t\t<a href=\"#\" id=\"" . $menuitem['id'] . "\">" . $menuitem['title'] . " +</a>\n" .
					"\t\t\t\t\t\t\t<ul>\n";

				foreach ($menuitem['submenu'] as $submenuitem) {
					$ret .=	"\t\t\t\t\t\t\t\t<li>\n" .
						"\t\t\t\t\t\t\t\t\t<a href=\"" . $submenuitem['url'] . "\" id=\"" . $submenuitem['id'] . "\">" . $submenuitem['title'] . "</a>\n" .
						"\t\t\t\t\t\t\t\t</li>\n";
				}
				$ret .=	"\t\t\t\t\t\t\t</ul>\n";
			}
			$ret .=	"\t\t\t\t\t\t</li>\n";
		}

		$ret .=	"\t\t\t\t\t</ul>\n" .
			"\t\t\t\t</div>\n" .
			"\n<!-- END FUNCTION _HTML_MENU //-->\n\n";

		return($ret);
	}

	private function _html_footer () {

		$ret =	"\n\n<!-- BEGIN FUNCTION _HTML_FOOTER //-->\n\n" .
			"\t\t\t<div id=\"footer\" class=\"clear\">\n" .
			"\t\t\t\t<div class=\"part1\">\n" .
			"\t\t\t\t\tCopyright © 2015 beroNet GmbH, Germany\n" .
			"\t\t\t\t</div>\n" .
			"\t\t\t\t<div class=\"part2\">\n" .
			"\t\t\t\t\t<div class=\"right\">\n" .
			"\t\t\t\t\t\t<a href=\"http://wiki.beronet.com/index.php/Gateway_app_" . $this->_page_title . "\" target=\"_blank\" id=\"help\">\n" .
			"\t\t\t\t\t\t\t<img src=\"/userapp/asterisk/img/help_button.png\" alt=\"Help\" />\n" .
			"\t\t\t\t\t\t</a>\n" .
			"\t\t\t\t\t</div>\n" .
			"\t\t\t\t</div>\n" .
			"\t\t\t</div>\n" .
			"\t\t</div>\n" .
			"\t</body>\n" .
			"</html>\n";

		return($ret);
	}

	function get_MainHeader ($menu, $module_name) {
		return($this->_html_header($menu, $module_name));
	}

	function get_MainFooter () {
		return($this->_html_footer());
	}
}

?>
