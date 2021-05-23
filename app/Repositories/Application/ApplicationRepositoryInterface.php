<?php

namespace App\Repositories\Application;

use App\Repositories\RepositoryInterface;

interface ApplicationRepositoryInterface extends RepositoryInterface
{
    public function getJob($id);

    public function apply($id, $userId);

    public function cancelApply($id, $userId);

    public function applyJobs($user);

    public function acceptOrReject($job, $userId, $status);

    public function showHistoryCreateJob($user);

    public function showListCandidateApply($job);
}
