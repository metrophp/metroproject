<?php

class Email_Swiftmailer {

	public $transport = NULL;
	public $mailer    = NULL;

	public function __construct($options=array()) {

		include_once 'local/swiftmailer/swiftmailer/lib/swift_required.php';
		$smtp_host     = 'localhost';
		$smtp_port     = '587';
		$smtp_security = '';

		if (array_key_exists('smtp_host', $options)) {
			$smtp_host = $options['smtp_host'];
		}
		if (array_key_exists('smtp_port', $options)) {
			$smtp_port = $options['smtp_port'];
		}
		if (array_key_exists('smtp_security', $options)) {
			$smtp_security = $options['smtp_security'];
		}

		if ($smtp_security == '') {
			$this->transport = Swift_SmtpTransport::newInstance($smtp_host, $smtp_port);
		} else {
			$this->transport = Swift_SmtpTransport::newInstance($smtp_host, $smtp_port, $smtp_security);
		}

		if (array_key_exists('smtp_user', $options)) {
			$this->transport->setUsername($options['smtp_user']);
		}
		if (array_key_exists('smtp_password', $options)) {
			$this->transport->setPassword($options['smtp_password']);
		}

		$this->mailer = Swift_Mailer::newInstance($this->transport);

		/*
		$message = Swift_Message::newInstance()
		  ->setSubject($subject)
		  ->setFrom($from)
		  ->setTo($to)
		  ->addPart($htmlBody, 'text/html');
		 */

	}

	public function newMessage() {
		return Swift_Message::newInstance();
	}

	public function send($message) {
		return $this->mailer->send($message);
	}
}
