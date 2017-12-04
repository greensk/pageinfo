<?php

if (empty($_GET['url'])) {
	show_error('Please pass the url via "url" param');
}
$url = $_GET['url'];

if (strpos('http://', $url) !== 0 && strpos('https://', $url)) {
	show_error('The url should start with http:// or https://');
}

$title = website_title($url);

if ($title === null) {
	show_error('Cannot read the url');
}

if (substr_count($title, '&mdash;') === 1) {
	$parts = explode('&mdash;', $title);
	$article = $parts[0];
	$source = $parts[1];
} else if (substr_count($title, '/') === 1) {
	$parts = explode('/', $title);
	$article = $parts[0];
	$source = $parts[1];
}  else if (substr_count($title, '—') === 1) {
	$parts = explode('—', $title);
	$article = $parts[0];
	$source = $parts[1];
} else if (substr_count($title, '-') === 1) {
	$parts = explode('-', $title);
	$article = $parts[0];
	$source = $parts[1];
} else {
	$article = $title;
	
	$source = parse_url($url, PHP_URL_HOST);
}

header('Content-Type: application/json; charset=UTF-8');
echo json_encode(['success' => true, 'source' => trim($source), 'name' => trim($article)], JSON_UNESCAPED_UNICODE);

function website_title($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$html = curl_exec($ch);
	curl_close($ch);

	$dom  = new DOMDocument;
	@$dom->loadHTML($html);

	if ($dom) {
		$title = @$dom->getElementsByTagName('title')->item('0')->nodeValue;
		return $title;
	} else {
		return null;
	}
}

function show_error($message) {
	die(json_encode(['success' => false, 'message' => $message]));
}
