<?php
/*
   DeleteFolder.php

   Marketo REST API Sample Code
   Copyright (C) 2016 Marketo, Inc.

   This software may be modified and distributed under the terms
   of the MIT license.  See the LICENSE file for details.
*/
$folder = new DeleteFolder();
$folder->type = "Folder";
$folder->id = 5565;
print_r($folder->postData());

class DeleteFolder{
	private $host = "CHANGE ME";
	private $clientId = "CHANGE ME";
	private $clientSecret = "CHANGE ME";
	public $id;//id of folder to update, required
	public $type;//type of folder, Folder or Program, required
	
	public function postData(){
		$url = $this->host . "/rest/asset/v1/folder/" . $this->id . ".json?access_token=" . $this->getToken() . "&type=" . $this->type;
		$ch = curl_init($url);
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_getinfo($ch);
		$response = curl_exec($ch);
		return $response;
	}
	
	private function getToken(){
		$ch = curl_init($this->host . "/identity/oauth/token?grant_type=client_credentials&client_id=" . $this->clientId . "&client_secret=" . $this->clientSecret);
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json',));
		$response = json_decode(curl_exec($ch));
		curl_close($ch);
		$token = $response->access_token;
		return $token;
	}	
}