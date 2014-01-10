<?php
class Message {
	
	/**
	 * Message ID
	 */
	private $id;
	
	/**
	 * Id of the person who sends the message
	 */
	private $from;
	/**
	 * Serialized array of the ID's of people to whom the message is to be sent.
	 */
	private $to;
	
	/**
	 * Subject of the message
	 */
	private $subject;
	
	/**
	 * Text of the message
	 */
	private $message;
	/**
	 * The date on which the Message was sent.
	 */
	private $date;
	
	function __construct(){
		$this->date = date("Y-m-d H:i:s");
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 *
	 * @param unknown_type $id        	
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getFrom() {
		return $this->from;
	}
	
	/**
	 *
	 * @param unknown_type $from        	
	 */
	public function setFrom($from) {
		$this->from = $from;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getTo() {
		return $this->to;
	}
	
	/**
	 *
	 * @param unknown_type $to        	
	 */
	public function setTo($to) {
		$this->to = $to;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getSubject() {
		return $this->subject;
	}
	
	/**
	 *
	 * @param unknown_type $subject        	
	 */
	public function setSubject($subject) {
		$this->subject = $subject;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getMessage() {
		return $this->message;
	}
	
	/**
	 *
	 * @param unknown_type $message        	
	 */
	public function setMessage($message) {
		$this->message = $message;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getDate() {
		return $this->date;
	}
	
	/**
	 *
	 * @param unknown_type $date        	
	 */
	public function setDate($date) {
		$this->date = $date;
		return $this;
	}
	
	public function send(){
		$service = new MessageService();
		$service->saveMessage($this);		
	}
	
}