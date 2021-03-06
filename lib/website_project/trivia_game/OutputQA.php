<?php

namespace website_project\trivia_game;

use website_project\database\Database as DB;
use PDO;
use DateTime;
use DateTimeZone;

class OutputQA {

    public $result = \NULL;
    public $data = \NULL;
    protected $pdo = \NULL;
    protected $q_num = \NULL;
    protected $query = \NULL;
    protected $stmt = \NULL;
    protected $today = \NULL;

    public function __construct() {
        
    }

    public function read($start = 0, $end = 10, $category = "movie") {
        $db = DB::getInstance();
        $pdo = $db->getConnection();
        $this->query = "SELECT id, question, answer1, answer2, answer3, answer4, correct, category, play_date FROM trivia_questions WHERE category=:category ORDER BY id ASC LIMIT :start, :end";
        $this->stmt = $pdo->prepare($this->query);

        $this->stmt->bindValue(':category', $category, PDO::PARAM_STR);
        $this->stmt->bindValue(':start', (int) $start, PDO::PARAM_INT);
        $this->stmt->bindValue(':end', (int) $end, PDO::PARAM_INT);
        

        $this->stmt->execute();

        $this->data = $this->stmt->fetchAll(PDO::FETCH_OBJ);

        return $this->data;
    }

    public function readQA($q_num) {
        $play_date = new DateTime("Now", new DateTimeZone("America/Detroit"));
        $db = DB::getInstance();
        $this->pdo = $db->getConnection();
        $this->query = "SELECT id, q_num, question, answer1, answer2, answer3, answer4, correct, play_date FROM trivia_questions WHERE q_num=:q_num AND play_date=:play_date";
        $this->stmt = $this->pdo->prepare($this->query);
        $this->stmt->execute([':q_num' => $q_num, ':play_date' => $play_date->format("Y-m-d")]);
        $this->data = $this->stmt->fetchAll(PDO::FETCH_OBJ);
        if ($this->data) {
            return $this->data;
        } else {
            return NULL;
        }
    }

    public function checkDailyTen($q_num, $answer) {
        $db = DB::getInstance();
        $this->pdo = $db->getConnection();
        $query = "SELECT  id, q_num, correct, play_date FROM the_daily_ten WHERE q_num=:q_num";
        $this->stmt = $this->pdo->prepare($query);
        $this->stmt->execute([':q_num' => $q_num]);
        $this->row = $this->stmt->fetch(PDO::FETCH_ASSOC);

        if ($this->row) {
            if ($this->row['correct'] === (int) $answer) {
                $this->data['correct'] = TRUE;
                $this->data['right_answer'] = $this->row['correct'];
                $this->data['user_answer'] = (int) $answer;
            } else {
                $this->data['correct'] = FALSE;
                $this->data['right_answer'] = $this->row['correct'];
                $this->data['user_answer'] = (int) $answer;
            }
            return $this->data;
        } else {
            return NULL;
        }
    }

}
