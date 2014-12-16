<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::import('Vendor', 'facebook', array('file' => 'facebook' . DS . 'facebook.php'));
App::uses('Controller', 'Controller');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	protected $fb = null;
	
	protected function createFacebook() {
		if ($this->fb != null) {
			$this->log('return existing Facebook Instance', LOG_DEBUG);
			return $this->fb;
		}
		$this->log('create new Facebook instance', LOG_DEBUG);
		$this->fb = new Facebook( array('appId' => '', 'secret' => '', ));
		return $this->fb;
	}
	
	function beforeFilter() {
		$facebook = $this -> createFacebook();
		$fb_user = $facebook -> getUser();
		$friends = null;
		if ($fb_user) {
			try {
				$me = $facebook -> api('/me');
				$this -> setThanksHistory($me['id']);
				$this -> set('me', $me);
				$friends = $facebook -> api('/me/friends');
				$this -> set('fb', $fb_user);
				$this -> set('friends', $friends);
			} catch (FacebookApiException $e) {
				$fb_user = null;
			}
		} else {
			//キャンパスページのURL
			$canvaspage = 'apps.facebook.com/thxheart/';
			//プロトコルの判別
			$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
			$fb_login_url = $facebook -> getLoginUrl(array('redirec_url' => $protocol . $canvaspage, 'scope' => 'publish_stream'));
			$this->redirect($fb_login_url);
		}
	}
	
	/**
	 * 左側のありがとう履歴表示用にデータを取得し、View表示用にセットします。
	 */
	protected function setThanksHistory($id) {
		$params = array(
			'conditions' => array(
				'or' => array(
					'Thank.from_id' => $id,
					'Thank.to_id' => $id
				)
			),
			'order' => 'Thank.created_date desc',
			'limit' => 30,
			'page' => 1
		);
		$thanks = $this -> Thank -> find('all', $params);
		$this -> set('thanks', $thanks);
		$this -> set('heartParts', $this->getHeartParts($thanks));
	}
	
	function getHeartParts($thanks) {
		$parts = array();
		$path = "/cakephp/app/webroot/img/heart_parts/";
		$count = 1;
		foreach ($thanks as $thank) {
			switch ($thank['Thank']['kinds']) {
				case 1:
					array_push($parts, $path.$this->getIndex($count)."_pink.png");
					break;
				case 2:
					array_push($parts, $path.$this->getIndex($count)."_yellow.png");
					break;
				case 3:
					array_push($parts, $path.$this->getIndex($count)."_green.png");
					break;
				case 4:
					array_push($parts, $path.$this->getIndex($count)."_blue.png");
					break;
				default:
					array_push($parts, "");
					break;
			}
			if ($count == 15) break;
			$count++;
		}
		return $parts;
	}
	
	function getIndex($count) {
		if ($count < 10) {
			return "0".$count;
		}
		return "".$count;
	}

}
