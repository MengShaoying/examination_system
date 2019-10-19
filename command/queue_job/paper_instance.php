<?php

queue_job('paper_instance_timeout', function ($data) {/*{{{*/

    unit_of_work(function () use ($data) {

        $paper_instance_id = $data['paper_instance_id'];

        $paper_instance = dao('paper_instance')->find($paper_instance_id);

        if (! $paper_instance->status_is_finished()) {

            $paper_instance->set_status_finished();
        }
    });

    log_module('queue', 'paper_instance '.$data['paper_instance_id'].' timeout');

    return true;

}, 10, [1, 1, 1], 'default');/*}}}*/
