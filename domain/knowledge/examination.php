<?php

define('EXAMINATION_START_TIME_RANGE_MARK', ' ~ ');

function explode_examination_start_time_range($examination_start_time)
{/*{{{*/
    $time_infos = explode(EXAMINATION_START_TIME_RANGE_MARK, $examination_start_time);

    return [
        'early' => datetime($time_infos[0], 'Y-m-d 00:00:00'),
        'last'  => datetime($time_infos[1], 'Y-m-d 23:59:59'),
    ];
}/*}}}*/

function implode_examination_start_time_rannge(examination $examination)
{/*{{{*/
    return datetime($examination->early_examination_start_time, 'Y-m-d').EXAMINATION_START_TIME_RANGE_MARK.datetime($examination->last_examination_start_time, 'Y-m-d');
}/*}}}*/
