<?php
namespace AutoClipper;

class EvernoteClipper
{
    private $secretEmail;
    private $mailer;
    private $sender;

    public function __construct($secretEmail, $sender, \Swift_Mailer $mailer)
    {
        $this->secretEmail = $secretEmail;
        $this->mailer = $mailer;
        $this->sender = $sender;
    }

    public function clip($title, $html, $notebook = null, $tags = [])
    {
        if ($notebook !== null) {
            $title .= ' @'.$notebook;
        }

        foreach ($tags as $tag) {
            $title .= ' #'.$tag;
        }

        $message = \Swift_Message::newInstance()
            ->setSubject($title)
            ->setTo([$this->secretEmail])
            ->setFrom($this->sender)
            ->setBody($html, 'text/html');
        $this->mailer->send($message);
    }
}
