<?php
/**
 * 
 * @author varun
 *	
 */
class Messages {
	
	private $message;
	
	function __construct(Message $msg){
		$this->message = $msg;
	}
	
	/**
	 * Writes message to the database
	 */
	function saveMessage(){
		
	}
	
	/**
	 * Returns the message object
	 */
	function getMessage(){
		
	}	
}