# up
CREATE TABLE `paper_template` (
    `id` bigint(20) NOT NULL,
    `version` int(11) NOT NULL,
    `create_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    `delete_time` datetime DEFAULT NULL,
    `title` varchar(45) NOT NULL,
    `random_question_count` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# down
drop table `paper_template`;
