<?php

namespace photon\mail\swiftmailer;
use photon\config\Container as Conf;

/*
 *  Initialize the From field from the photon configuration
 *  Helpers to use the template engine to render email message
 */ 
class Message extends \Swift_Message
{
  public function __construct($subject = null, $body = null, $contentType = null, $charset = null)
  {
    parent::__construct($subject, $body, $contentType, $charset);

    $from = Conf::f('email_no_reply', null);
    if ($from === null) {
      throw new \Exception('configuration key email_no_reply is not set');
    }
    $this->setFrom($from);
  }

  public function setBobyFromTemplate($template, $ctx, $mime='text/plain')
  {
    $ctx = new \photon\template\Context($ctx);
    $renderer = new \photon\template\Renderer($template, Conf::f('template_folders'));
    $txt = $renderer->render($ctx);

    $this->setBody($txt, $mime);
  }

  public function addPartFromTemplate($template, $ctx, $mime='text/html')
  {
    $ctx = new \photon\template\Context($ctx);
    $renderer = new \photon\template\Renderer($template, Conf::f('template_folders'));
    $html = $renderer->render($ctx);

    $this->addPart($html, $mime);
  }
}
