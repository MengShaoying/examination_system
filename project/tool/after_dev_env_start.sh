#!/bin/bash

ENV=development php /var/www/examination_system/public/cli.php migrate:install
ENV=development php /var/www/examination_system/public/cli.php migrate
