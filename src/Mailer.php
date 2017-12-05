<?php

namespace photon\mail\swiftmailer;
use photon\config\Container as Conf;

/*
 *  Initialize the transport backend from the photon configuration
 */ 
class Mailer extends \Swift_Mailer
{
  public function __construct()
  {
    $backend = Conf::f('mail_backend', 'smtp');

    switch ($backend) {
      case 'sendmail':
        $this->initSendmail();
        break;

      case 'smtp':
        $this->initSMTP();
        break;

      default:
        throw new \Exception('Unknown mail backend');
        break;
    }
  }

  private function initSendmail()
  {
    $cmd = Conf::f('mail_sendmail_path', null);
    if ($cmd === null) {
      throw new \Exception('configuration key mail_sendmail_path is not set');
    }

    $args = Conf::f('mail_sendmail_path', null);
    if ($args !== null) {
      $cmd .= ' ' . $args;
    }

    $transport = new Swift_SendmailTransport($cmd);
    parent::__construct($transport);
  }

  private function initSMTP()
  {
    $server = Conf::f('mail_host', null);
    if ($server === null) {
      throw new \Exception('configuration key mail_host is not set');
    }

    $port = Conf::f('mail_port', null);
    if ($server === null) {
      throw new \Exception('configuration key mail_port is not set');
    }

    $smtp = new \Swift_SmtpTransport($server, $port);

    if (Conf::f('mail_auth', false)) {
      $username = Conf::f('mail_username', null);
      if ($username !== null) {
        $smtp->setUsername($username);
      }

      $password = Conf::f('mail_password', null);
      if ($password !== null) {
        $smtp->setPassword($password);
      }
    }

    parent::__construct($smtp);
  }
}
