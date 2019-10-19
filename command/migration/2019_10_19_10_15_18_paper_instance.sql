# up
CREATE TABLE `paper_instance` (
    `id` bigint(20) NOT NULL,
    `version` int(11) NOT NULL,
    `create_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    `delete_time` datetime DEFAULT NULL,
    `start_time` datetime DEFAULT NULL,
    `total_score` int(11) NOT NULL,
    `examination_id` bigint(20) NOT NULL,
    `account_id` bigint(20) NOT NULL,
    KEY `fk_examination_idx` (`examination_id`, `delete_time`),
    KEY `fk_account_idx` (`account_id`, `delete_time`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# down
drop table `paper_instance`;
