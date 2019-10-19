# up
CREATE TABLE `answer_selection` (
    `id` bigint(20) NOT NULL,
    `version` int(11) NOT NULL,
    `create_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    `delete_time` datetime DEFAULT NULL,
    `paper_instance_question_answer_id` bigint(20) NOT NULL,
    `selection_id` bigint(20) NOT NULL,
    KEY `fk_paper_instance_question_answer_idx` (`paper_instance_question_answer_id`, `delete_time`),
    KEY `fk_selection_idx` (`selection_id`, `delete_time`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# down
drop table `answer_selection`;