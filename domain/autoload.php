<?php

spl_autoload_register(function ($class_name) {

    $class_maps = [
        'paper_template_question_dao' => 'dao/paper_template_question.php',
        'selection_dao' => 'dao/selection.php',
        'question_category_dao' => 'dao/question_category.php',
        'question_dao' => 'dao/question.php',
        'paper_instance_question_answer_dao' => 'dao/paper_instance_question_answer.php',
        'account_dao' => 'dao/account.php',
        'paper_template_dao' => 'dao/paper_template.php',
        'answer_selection_dao' => 'dao/answer_selection.php',
        'examination_dao' => 'dao/examination.php',
        'paper_instance_dao' => 'dao/paper_instance.php',
        'paper_template_question' => 'entity/paper_template_question.php',
        'selection' => 'entity/selection.php',
        'question_category' => 'entity/question_category.php',
        'question' => 'entity/question.php',
        'paper_instance_question_answer' => 'entity/paper_instance_question_answer.php',
        'account' => 'entity/account.php',
        'paper_template' => 'entity/paper_template.php',
        'answer_selection' => 'entity/answer_selection.php',
        'examination' => 'entity/examination.php',
        'paper_instance' => 'entity/paper_instance.php',
    ];

    if (isset($class_maps[$class_name])) {
        include __DIR__.'/'.$class_maps[$class_name];
    }
});
