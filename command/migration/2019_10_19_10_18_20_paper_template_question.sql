# up
CREATE TABLE `paper_template_question` (
    `id` bigint(20) NOT NULL,
    `version` int(11) NOT NULL,
    `create_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    `delete_time` datetime DEFAULT NULL,
    `paper_template_id` bigint(20) NOT NULL,
    `question_id` bigint(20) NOT NULL,
    KEY `fk_paper_template_idx` (`paper_template_id`, `delete_time`),
    KEY `fk_question_idx` (`question_id`, `delete_time`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# down
drop table `paper_template_question`;