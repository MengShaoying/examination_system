# up
CREATE TABLE `account` (
    `id` bigint(20) NOT NULL,
    `version` int(11) NOT NULL,
    `create_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    `delete_time` datetime DEFAULT NULL,
    `name` varchar(45) NOT NULL,
    `password` varchar(45) NOT NULL,
    `role` varchar(45) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# down
drop table `account`;