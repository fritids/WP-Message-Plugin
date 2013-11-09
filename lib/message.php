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
	 * Text of the message
	 */
	private $message;
	/**
	 * The date on which the Message was sent.
	 */
	private $sentDate;
	
	function getId(){
		return $this->id;
	}
	
	function getFrom() {
		return $this->from;
	}
	
	function setFrom($from){
		$this->from = $from;
		return $this;
	}
	
	function getTo(){
		return $this->to;
	}
	
	function setTo($to){
		$this->to = $to;
		return $this;
	}
	
	function getMessage(){
		return $this->message;
	}
	
	function setMessage($msg){
		$this->message = $msg;
		return $this;
	}
	
	function getDate(){
		return $this->sentDate;
	}
	
	function setDate($date){
		$this->sentDate = $date;
		return $this;
	}
}