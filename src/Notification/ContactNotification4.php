<?php
namespace App\Notification;

use App\Entity\Mailbox;
use Twig\Environment;

class ContactNotification4
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Mailbox $contact)
    {
        $message = (new \Swift_Message('Agence Web - Réponse à votre demande pour ' . $contact->getSubject()))
            ->setFrom('no-reply@agence-web.website', 'AgenceWeb - Le mans')
            ->setTo($contact->getEmail())
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('emails/contact4.html.twig', [
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send($message);
    }

}

?>