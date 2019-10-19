# up
CREATE TABLE `examination` (
    `id` bigint(20) NOT NULL,
    `version` int(11) NOT NULL,
    `create_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    `delete_time` datetime DEFAULT NULL,
    `early_examination_start_time` datetime NOT NULL,
    `last_examination_start_time` datetime NOT NULL,
    `description` varchar(1000) NOT NULL,
    `paper_template_id` bigint(20) NOT NULL,
    KEY `fk_paper_template_idx` (`paper_template_id`, `delete_time`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# down
drop table `examination`;
