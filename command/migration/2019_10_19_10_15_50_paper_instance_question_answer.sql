# up
CREATE TABLE `paper_instance_question_answer` (
    `id` bigint(20) NOT NULL,
    `version` int(11) NOT NULL,
    `create_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    `delete_time` datetime DEFAULT NULL,
    `score` int(11) NOT NULL,
    `sequence` int(11) NOT NULL,
    `paper_instance_id` bigint(20) NOT NULL,
    `paper_template_question_id` bigint(20) NOT NULL,
    KEY `fk_paper_instance_idx` (`paper_instance_id`, `delete_time`),
    KEY `fk_paper_template_question_idx` (`paper_template_question_id`, `delete_time`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# down
drop table `paper_instance_question_answer`;