<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]  .= $page[ 'title_separator' ].'Vulnerability: Command Execution';
$page[ 'page_id' ] = 'exec';
$page[ 'help_button' ]   = 'exec';
$page[ 'source_button' ] = 'exec';

dvwaDatabaseConnect();

$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
	case 'low':
		$vulnerabilityFile = 'low.php';
		break;

	case 'medium':
		$vulnerabilityFile = 'medium.php';
		break;

	case 'high':
	default:
		$vulnerabilityFile = 'high.php';
		break;
}

require_once DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/exec/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Vulnerability: Command Execution</h1>

	<div class=\"vulnerable_code_area\">
		<h2>Ping a device</h2>

		<form name=\"ping\" action=\"#\" method=\"post\">
			<p>
				Enter an IP address:
				<input type=\"text\" name=\"ip\" size=\"30\">
				<input type=\"submit\" value=\"Submit\" name=\"submit\">
			</p>
		</form>
		{$html}
	</div>

	<h2>More Information</h2>
	<ul>
		<li>".dvwaExternalLinkUrlGet( 'http://www.scribd.com/doc/2530476/Php-Endangers-Remote-Code-Execution' )."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.ss64.com/bash/' )."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.ss64.com/nt/' )."</li>
		<li>".dvwaExternalLinkUrlGet( 'https://www.owasp.org/index.php/Command_Injection' )."</li>
	</ul>
</div>
";

dvwaHtmlEcho( $page );

?>
