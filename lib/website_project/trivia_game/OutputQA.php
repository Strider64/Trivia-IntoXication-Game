<?php

namespace website_project\trivia_game;

use website_project\database\Database as DB;
use PDO;
use DateTime;
use DateTimeZone;

class OutputQA {

    public $result = \NULL;
    protected $pdo = \NULL;
    protected $q_num = \NULL;
    protected $query = \NULL;
    protected $stmt = \NULL;
    protected $today = \NULL;

    public function __construct() {
        
    }
    
    public function readQA($q_num) {
        $db = DB::getInstance();
        $this->pdo = $db->getConnection();
        $this->query = "SELECT id, q_num, question, answer1, answer2, answer3, answer4, play_date FROM the_daily_ten WHERE q_num=:q_num";
        $this->stmt = $this->pdo->prepare($this->query);
        $this->stmt->execute([':q_num' => $q_num]);
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