<?php
namespace AutoClipper;

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

        $message = \Swift_Message::newInstance()
            ->setSubject($title)
            ->setTo([$this->secretEmail])
            ->setFrom($this->secretEmail)
            ->setBody($html, 'text/html');

        $transport = \Swift_MailTransport::newInstance();
        $mailer = \Swift_Mailer::newInstance($transport);
        $mailer->send($message);
    }
}
