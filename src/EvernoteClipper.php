<?php
namespace AutoClipper;

use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;

class EvernoteClipper
{
    private $secretEmail;

    public function __construct($secretEmail)
    {
        $this->secretEmail = $secretEmail;
    }

    public function clip($title, $html, $notebook = null, $tags = [])
    {
        if ($notebook !== null) {
            $title .= ' @'.$notebook;
        }

        foreach ($tags as $tag) {
            $title .= ' #'.$tag;
        }

        $message = new Message();
        $message->addTo($this->secretEmail)
            ->setSubject($title)
            ->setHTMLBody($html);

        $mailer = new SendmailMailer();
        $mailer->send($message);
    }
}
