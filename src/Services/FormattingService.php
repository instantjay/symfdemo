<?php

namespace App\Services;

use App\Entities\Project;

class FormattingService
{
    /**
     * @param double $value
     * @param Project $project
     * @return double
     */
    public function roundValueBasedOnProject($value, Project $project)
    {
        $closure = $project->getRoundingStrategy();

        $value = $closure($value);

        return round($value, $project->getPreferredDecimals());
    }
}
