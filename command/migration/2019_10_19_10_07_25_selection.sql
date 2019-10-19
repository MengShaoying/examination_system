# up
CREATE TABLE `selection` (
    `id` bigint(20) NOT NULL,
    `version` int(11) NOT NULL,
    `create_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    `delete_time` datetime DEFAULT NULL,
    `description` varchar(45) NOT NULL,
    `is_right` varchar(45) NOT NULL,
    `score` int(11) NOT NULL,
    `question_id` bigint(20) NOT NULL,
    KEY `fk_question_idx` (`question_id`, `delete_time`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# down
drop table `selection`;