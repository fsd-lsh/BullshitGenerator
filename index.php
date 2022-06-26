<?php

/**
 * Class index
 * Author: Force https://www.easybhu.cn/tools.html
 * Email:  lisihan@outlook.com
 */
class index
{

    private $db_file;

    public function __construct() {
        $this->db_file = file_get_contents('data.json');
        $this->db_file = json_decode($this->db_file, true);
    }

    public function run() {

        $subject = $_POST['subject'];
        if(empty($subject)) {
            $this->ajax(0, '主题不能为空');
        }

        $article = '';
        $section = '';
        $section_len = 0;
        while ($section_len < 6000) {
            $rand_num = $this->rand_num();
            if($rand_num < 5 && $section_len > 200) {
                $section = $this->add_section($section) . "\n";
                $article .= $section;
                $section = '';
            }else if ($rand_num < 20) {
                $word = $this->get_quotes();
                $section_len = $section_len + strlen($word);
                $section = $section . $word;
            }else {
                $word = $this->get_paper($subject);
                $section_len = $section_len + strlen($word);
                $section = $section . $word;
            }
        }
        $section = $this->add_section($section);
        $article .= $section;
        $this->ajax(1, 'ok', $article);
    }

    private function rand_str($data = NULL) {
        if(empty($data) || !is_array($data)) {
            return '';
        }
        return $data[rand(0, count($data) - 1)];
    }

    private function get_paper($subject) {
        $paper = $this->rand_str($this->db_file['bosh']);
        $paper = str_replace('x', $subject, $paper);
        return $paper;
    }

    private function get_quotes() {
        $quotes = $this->rand_str($this->db_file['famous']);
        $quotes = str_replace('a', $this->rand_str($this->db_file['before']), $quotes);
        $quotes = str_replace('b', $this->rand_str($this->db_file['after']), $quotes);
        return $quotes;
    }

    private function add_section($section) {
        if(strlen($section) && $section[strlen($section) - 1] === " ") {
            $section = mb_substr($section,0, -2);
        }
        return "　　" . $section . "。 ";
    }

    private function rand_num($min = 0, $max = 100) {
        return rand($min, $max);
    }

    private function ajax($code = null, $info = '', $data = []) {
        $res = [
            'code' => $code,
            'info' => $info,
            'data' => $data,
        ];
        echo json_encode($res);
        exit;
    }
}

(new index()) -> run();

