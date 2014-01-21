<?php
/**
 * 
 * @author varun
 *	
 */
class MessageService {
	
	function __construct(){
		$this->message = null;
	}
	
	/**
	 * Writes message to the database
	 */
	function saveMessage($message){
		global $wpdb;
		$to = $message->getTo();
		foreach($to as $user) {
			$wpdb->insert('wp_vmp_messages',array(
				'msg_from' => $message->getFrom(),
				'msg_to' => $user,
				'subject' => $message->getSubject(),
				'message' => $message->getMessage(),
				'sent_date' => $message->getDate(),
			));
		}
	}
	
	/**
	 * Returns array of Messages for user with $id
	 */
	function getUserMessages($id){
		global $wpdb;
		$sql = "SELECT * FROM wp_vmp_messages WHERE `msg_to`=$id ORDER BY sent_date";
		$messages = $wpdb->get_results($sql,ARRAY_A);
		return $messages;
	}
}