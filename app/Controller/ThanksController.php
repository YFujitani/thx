<?php
class ThanksController extends AppController {
	
	public $name = 'Thanks';
	public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');

	public function index() {
		parent::beforeFilter();
		$this->setThanksByKindAndTotalPoint($this->viewVars["fb"]);
	}
	
	public function other() {
		parent::beforeFilter();
		// パラメータチェック IDが渡って来なかった場合、自分だった場合はindexに飛ばす
		$query = $this->request->query;
		if (!array_key_exists('id', $query) || is_null($query['id']) || $query['id'] == $this->viewVars['me']['id']) {
			$this->redirect(array('action' => 'index'));
		}
		$friend_id = $query['id'];
		// IDから友達のありがとうリストを取得
		parent::setThanksHistory($friend_id);
		$this->setThanksByKindAndTotalPoint($friend_id);
		
		// $meを上書き
		$friend = parent::createFacebook()->api('/'.$friend_id);
		$me = array('id'=>$friend_id, 'first_name'=>$friend['first_name']);
		$this->set('me', $me);
	}
	
	public function say() {
		parent::beforeFilter();
	}

	public function logout() {
		//parent::beforeFilter();
		$this->log('logout is called', LOG_DEBUG);
		parent::createFacebook()->destroySession();
		$this->redirect(array('action' => 'index'));
	}

	public function register() {
		
		// 入力画面で設定したワンタイムトークンの確認を行う
		$key = array_search($_POST['token'], $_SESSION['token']);
		if ($key == false) {
			$this->log('Invalid Token', LOG_DEBUG);
			$this->redirect(array('action' => 'index'));
			return;
		}
		
		unset($_SESSION['token'][$key]); // 使用済みトークンを破棄
		$this->log('Token OK', LOG_DEBUG);
		
		if (!array_key_exists('to_id', $this->data) || !array_key_exists('from_id', $this->data) || !array_key_exists('kinds', $this->data)) {
			$this->log('redirect to TOP', LOG_DEBUG);
			$this->redirect(array('action' => 'index'));
			return;
		}
		$this -> Thank -> create($this->data);
		$this -> Thank -> set('created_date', DboSource::expression('NOW()'));
		$this -> Thank -> save();
		$this -> log('function register done', LOG_DEBUG);
		// TODO 完了画面用のパラメータをセット
		$result = $this->data;
		$this -> log($result, LOG_DEBUG);
		// 人にあげたポイントの総計の3分の1->ありがとうポイントを取得する
		$nextThanksPoint = $this->Thank->query($this->getNextThanksSql(), array($this->viewVars["fb"]));
		$this -> log($nextThanksPoint, LOG_DEBUG);
		$this -> set('nextThanksPoint', 3 - $nextThanksPoint[0][0]['thanksPoint']);
		
		$toUserPoint = $this->Thank->query($this->getKindSql($result['to_id']));
		$this -> log($toUserPoint, LOG_DEBUG);
		$this -> set('toUserPoint', $toUserPoint);
		
		$this -> set('result', $result);
		
	}

	/**
	 * 人からもらった種別毎ポイントの総計と
	 * ありがとうポイント（人にあげたポイントの3分の1）を取得し、
	 * Viewでの表示用にセットします。
	 */
	private function setThanksByKindAndTotalPoint($id) {
		// 人からもらった種別毎ポイントの総計を取得する
		$this->set("thanksByKind", $this->createThanksByKindModel($this->Thank->query($this->getKindSql(), array($id))));
		// 人にあげたポイントの総計の3分の1->ありがとうポイントを取得する
		$this->set("thanksPoint", $this->Thank->query($this->getAllThanksSql(), array($id)));
	}
	
	private function getKindSql($id) {
		return "select kinds, count(kinds) as count from thanks where to_id = ? group by kinds order by kinds asc;";
	}
	
	private function getAllThanksSql($id) {
		return "select count(kinds) DIV 3 as thanksPoint from thanks where from_id = ?";
	}
	
	private function getNextThanksSql($id) {
		return "select count(kinds) % 3 as thanksPoint from thanks where from_id = ?";
	}
	
	private function createThanksByKindModel(&$thanksByKind) {
		$tmp = array();
		for ($i = 1; $i < 5; $i++) {
			foreach ($thanksByKind as $thanks) {
				if ($thanks['thanks']['kinds'] == $i) {
					$tmp[$i] = $thanks[0]['count'];
				}
			}
			if (!array_key_exists($i, $tmp)) {
				$tmp[$i] = 0;
			}
		}
		return $tmp;
	}

}
