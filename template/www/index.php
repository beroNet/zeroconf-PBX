<?php

# Define functions below this line.
# Define functions above this line.

# Name of your app:
$app_name = 'example';

# Basepath of your app:
$base_path = '/apps/' . $app_name;

# BEGIN Session management #

$redir_login = '/app/berogui/includes/login.php';

@session_start();
if (!isset($_SESSION['beroari_time'])) {
	header('Location:' . $redir_login . '?userapp=' . $app_name);
	exit();
} elseif ((isset($_SESSION['beroari_time'])) && (($_SESSION['beroari_time'] + 1200) < time())) {
	@session_unset();
	@session_destroy();
	header('Location:' . $redir_login . '?reason=sess_expd&userapp=' . $app_name);
	exit();
}

unset($redir_login);

$_SESSION['beroari_time'] = time();

#  END session management  #

echo	"<xml version=\"1.0\" encoding=\"UTF-8\">\n" .
	"\t<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\n" .
	"<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\">\n" .
	"\t<head>\n" .
	"\t\t<title>" . $app_name . "</title>\n" .
	"\t</head>\n" .
	"\t<body>\n" .
	"\t\t<h1>" . $app_name . "</h1>\n" .
	"\t\t<div>Fill me with content and make me pretty!</div>\n" .
	"\t</body>\n" .
	"</html>\n";

?>
