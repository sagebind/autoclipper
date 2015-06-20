<?php
namespace AutoClipper;

require dirname(__DIR__).'/vendor/autoload.php';

if (!isset($_GET['url'])) {
    echo 'Error: No URL given to clip';
    exit;
}

$transport = \Swift_SmtpTransport::newInstance($config['smtp']['host'], 25)
    ->setUsername($config['smtp']['username'])
    ->setPassword($config['smtp']['password']);
$mailer = \Swift_Mailer::newInstance($transport);

$readability = new Readability($config['readability_token']);
$evernote = new EvernoteClipper($config['evernote_email'], $config['sender'], $mailer);

$article = $readability->parseUrl($_GET['url']);

$notebook = isset($_GET['notebook']) ? $_GET['notebook'] : null;
$tags = isset($_GET['tags']) ? explode(',', $_GET['tags']) : [];

$html = '<h1>'.$article->title.'</h1>';
if (isset($article->author)) {
    $html .= '<p>'.$article->author.'</p>';
}
$html .= $article->content;

$evernote->clip($article->title, $html, $notebook, $tags);
