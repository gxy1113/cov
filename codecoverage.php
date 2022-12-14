<?php
    $current_dir = '/var/www/codecoverage';
    $test_name = (isset($_COOKIE['7NSxAuhYVeOOzxKYRN5UabUrraXwpIM0Rm9ol66fBwFVyLUb']) && !empty($_COOKIE['7NSxAuhYVeOOzxKYRN5UabUrraXwpIM0Rm9ol66fBwFVyLUb'])) ? $_COOKIE['7NSxAuhYVeOOzxKYRN5UabUrraXwpIM0Rm9ol66fBwFVyLUb'] : 'unknown_test_' . time();
    xdebug_start_code_coverage(XDEBUG_CC_UNUSED | XDEBUG_CC_DEAD_CODE);

    function end_coverage()
    {
        global $test_name;
        global $current_dir;
        $coverageName = $current_dir . '/coverages/coverage-' . $test_name . '-' . microtime(true);

        try {
            xdebug_stop_code_coverage(false);
            $coverageName = $current_dir . '/coverages/coverage-' . $test_name . '-' . microtime(true);
            $codecoverageData = json_encode(xdebug_get_code_coverage());
            file_put_contents($coverageName . '.json', $codecoverageData);
        } catch (Exception $ex) {
            file_put_contents($coverageName . '.ex', $ex);
        }
    }

    class coverage_dumper
    {
        function __destruct()
        {
            try {
                end_coverage();
            } catch (Exception $ex) {
                echo str($ex);
            }
        }
    }

    $_coverage_dumper = new coverage_dumper();