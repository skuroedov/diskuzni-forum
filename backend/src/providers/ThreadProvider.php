<?php


namespace Forum\providers;


use Forum\App;
use Forum\entities\Thread;
use Forum\utils\Arrays;

class ThreadProvider extends Provider
{
	protected function setTableName() {
		return 'thread';
	}

	protected function setClass() {
		return Thread::class;
	}

	public function getAll() {
		$res = App::getDb()->select($this->tableName, '*');
		$threads = Arrays::arrayAssocToObj($res, $this->class);
		$userProvider = new UserProvider();
		$res = [];

		foreach($threads as $thread) {
			try {
				$author = $userProvider->getById($thread->author);
				$thread->author = $author;
				array_push($res, $thread);
			} catch(\Exception $e) {
				throw $e;
			}
		}
		return $res;
	}

	public function createNew($title, $text) {
		try {
			session_start();
			if(!$_SESSION['loggedIn']) {
				throw new \Exception('Uživatel není přihlášen');
			}

			$user = (new UserProvider())->getByUsername($_SESSION['username']);

			App::getDb()->insert($this->tableName, ['title' => $title, 'author' => $user->id, 'category' => 1, 'text' => $text]);
		} catch(\Exception $e) {
			throw $e;
		}
		return 'Příspěvek přidán';
	}
}