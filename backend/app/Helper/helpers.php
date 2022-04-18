<?php
use App\Helpers\DayFrame;
use App\Patient;
use App\Section;
use Carbon\CarbonImmutable;

$WEEK_DAYS = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];

define('WEEK_DAYS', $WEEK_DAYS);

function dates($month)
{
    $month = date('Y-m');
    $weekDay = date('w',strtotime($month));
    $dates = [];

    for($weekDay; $weekDay >= 1; $weekDay -= 1) {
        $dates[] = new CarbonImmutable('$month -$weekDay day');
    }
    $lastDay = date('d', strtotime('last day of $month'));

    for($day = 1; $day <= $lastDay; $day += 1) {
        $dates[] = CarbonImmutable('$month-$day');
    }

    $weekDay = date('w',strtotime('$month-$lastDay'));

    for ($day =1 ; $day <= 6 - $weekDay; $day += 1)
    {
        $dates[] = new CarbonImmutable('$month-$lastDay + $day day');
    }

  return $dates;
}

function calendar(Section $section, Patient $patient, String $month)
{

}