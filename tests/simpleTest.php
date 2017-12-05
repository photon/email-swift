<?php

class simpleTests extends \photon\test\TestCase
{
    public function testInitMailerFromConfig()
    {
        $mailer = new \photon\mail\swiftmailer\Mailer;
    }

    public function testInitMessageFromConfig()
    {
        $message = new \photon\mail\swiftmailer\Message;
    }

    public function testMessageUsingTemplate()
    {
        $message = new \photon\mail\swiftmailer\Message;

        $params = array(
            'name' => 'J.Doe'
        );
        $message->setBobyFromTemplate('welcome.txt', $params);
        $message->addPartFromTemplate('welcome.html', $params, 'text/html');
    }
}
