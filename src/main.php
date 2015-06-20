<?php
namespace AutoClipper;

require dirname(__DIR__).'/vendor/autoload.php';

if (!isset($_GET['url'])) {
    echo 'Error: No URL given to clip';
    exit;
}

if (!isset($_GET['token'])) {
    echo 'Error: No Readability token given';
    exit;
}

if (!isset($_GET['email'])) {
    echo 'Error: No Evernote email address given';
    exit;
}

$readability = new Readability($_GET['token']);
$evernote = new EvernoteClipper($_GET['email']);

$article = $readability->parseUrl($_GET['url']);

$notebook = isset($_GET['notebook']) ? $_GET['notebook'] : null;
$tags = isset($_GET['tags']) ? explode(',', $_GET['tags']) : [];

$html = '<h1>'.$article->title.'</h1>';
if (isset($article->author)) {
    $html .= '<p>'.$article->author.'</p>';
}
$html .= $article->content;

$evernote->clip($article->title, $html, $notebook, $tags);
