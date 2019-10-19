# up
CREATE TABLE `question` (
    `id` bigint(20) NOT NULL,
    `version` int(11) NOT NULL,
    `create_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    `delete_time` datetime DEFAULT NULL,
    `description` varchar(1000) NOT NULL,
    `selection_type` varchar(45) NOT NULL,
    `score` int(11) NOT NULL,
    `question_category_id` bigint(20) NOT NULL,
    KEY `fk_question_category_idx` (`question_category_id`, `delete_time`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# down
drop table `question`;