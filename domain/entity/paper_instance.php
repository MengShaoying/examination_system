<?php

class paper_instance extends entity
{
    public $structs = [
        'start_time' => '',
        'total_score' => '',
        'examination_id' => '',
        'account_id' => '',
        'status' => '',
    ];

    public static $entity_display_name = '试卷';
    public static $entity_description = '管理试卷';

    public static $struct_types = [
        'start_time' => 'text',
        'total_score' => 'number',
        'examination_id' => 'number',
        'account_id' => 'number',
        'status' => 'enum',
    ];

    public static $struct_display_names = [
        'start_time' => '开考时间',
        'total_score' => '总分',
        'examination_id' => '考试ID',
        'account_id' => '账号ID',
        'status' => '状态',
    ];

    public static $struct_descriptions = [
        'start_time' => '开考时间',
        'total_score' => '总分',
        'examination_id' => '考试ID',
        'account_id' => '账号ID',
        'status' => '状态',
    ];

    const STATUS_INIT = 'INIT';
    const STATUS_FINISHED = 'FINISHED';
    const STATUS_REJECT = 'REJECT';

    const STATUS_MAPS = [
        self::STATUS_INIT => '待考',
        self::STATUS_FINISHED => '结束',
        self::STATUS_REJECT => '罢考',
    ];

    public static $struct_formats = [
        'status' => self::STATUS_MAPS,
    ];

    public static $struct_format_descriptions = [
        'status' => '',
    ];

    public function __construct()
    {/*{{{*/
        $this->belongs_to('examination');
        $this->belongs_to('account');
        $this->has_many('paper_instance_question_answers', 'paper_instance_question_answer');
    }/*}}}*/

    public static function create(examination $examination)
    {/*{{{*/
        $paper_template = $examination->paper_template;

        $paper_template_questions = $paper_template->paper_template_questions;

        $paper_instance = parent::init();

        $paper_instance->examination = $examination;
        $paper_instance->set_status_init();

        $rand_paper_template_questions = (array) array_rand($paper_template_questions, min($paper_template->random_question_count, count($paper_template_questions)));

        shuffle($rand_paper_template_questions);

        foreach ($rand_paper_template_questions as $sequence => $paper_template_question_id) {

            $paper_instance_question_answer = paper_instance_question_answer::create();

            $paper_instance_question_answer->sequence = $sequence;
            $paper_instance_question_answer->paper_instance = $paper_instance;
            $paper_instance_question_answer->paper_template_question_id = $paper_template_question_id;
        }

        return $paper_instance;
    }/*}}}*/

    public function get_status_description()
    {/*{{{*/
        return self::STATUS_MAPS[$this->status];
    }/*}}}*/

    public function set_status_init()
    {/*{{{*/
        $this->status = self::STATUS_INIT;
    }/*}}}*/

    public function set_status_reject()
    {/*{{{*/
        $this->status = self::STATUS_REJECT;
    }/*}}}*/

    public function set_status_finished()
    {/*{{{*/
        $this->status = self::STATUS_FINISHED;
    }/*}}}*/

    public function status_is_init()
    {/*{{{*/
        return $this->status === self::STATUS_INIT;
    }/*}}}*/

    public function status_is_finished()
    {/*{{{*/
        return $this->status === self::STATUS_FINISHED;
    }/*}}}*/

}
