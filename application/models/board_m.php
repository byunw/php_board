<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Board_m extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function get_list() {
		$sql="SELECT * FROM ci_board";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;
	}

	function insert_post($user_id,$username,$title,$content){
		date_default_timezone_set('Asia/Tokyo');
		$sql="INSERT INTO ci_board(user_id,user_name,subject,contents,reg_date) VALUES ('" . $user_id ."','" . $username ."','" . $title ."','" . $content ."','" . date('Y-m-d H:i:s') ."')";
		$query=$this->db->query($sql);
	}

	function retrieve($board_id){
		$sql="select * from ci_board where board_id=".$board_id;
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;
	}

	function checkid_duplicate($user_id){
		$sql="select * from user where username = ?";
		$query=$this->db->query($sql,array($user_id));
		return $query->num_rows();
	}

	function insert_user($user_id,$name,$password){

		$sql="INSERT INTO user(username,name,password) VALUES ('". $user_id ."','". $name ."','". $password ."')";
		$query=$this->db->query($sql);

	}


}


