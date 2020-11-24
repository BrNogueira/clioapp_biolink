<?php

namespace Altum;

class Date {
    public static $date;
    public static $timezone = '';

    public static function validate($date, $format = 'Y-m-d') {
        $d = \DateTime::createFromFormat($format, $date);

        return $d && $d->format($format) === $date;
    }

    /* Helper to easily and fast output dates to the screen */
    public static function get($date = '', $format_type = 0, $timezone = '') {

        $timezone = !$timezone ? self::$timezone : $timezone;

        /* No custom formatting */
        if($date == '') {

            return (new \DateTime())->setTimezone(new \DateTimeZone($timezone))->format('Y-m-d H:i:s');

        } else {

            $datetime = (new \DateTime($date))->setTimezone(new \DateTimeZone($timezone));

            switch($format_type) {
                case 0:
                    return sprintf(
                        Language::get()->global->date->datetime_ymd_format,
                        $datetime->format('Y'),
                        $datetime->format('m'),
                        $datetime->format('d')
                    );

                    break;

                case 1:

                    return sprintf(
                        Language::get()->global->date->datetime_ymd_his_format,
                        $datetime->format('Y'),
                        $datetime->format('m'),
                        $datetime->format('d'),
                        $datetime->format('H'),
                        $datetime->format('i'),
                        $datetime->format('s')
                    );

                    break;

                case 2:

                    return sprintf(
                        Language::get()->global->date->datetime_readable_format,
                        $datetime->format('j'),
                        Language::get()->global->date->long_months->{$datetime->format('n')},
                        $datetime->format('Y')
                    );

                    break;

                case 3:

                    return sprintf(
                        Language::get()->global->date->datetime_his_format,
                        $datetime->format('H'),
                        $datetime->format('i'),
                        $datetime->format('s')
                    );

                    break;

                /* No specific format type */
                default:

                    return $datetime->format($format_type);

                    break;
            }

        }

    }

    /* Helper to retrieve the current format of datetime to output */
    public static function get_format($type = 0) {

        switch($type) {
            case 0:
                return Language::get()->global->date->datetime_ymd_format;
                break;

            case 1:
                return Language::get()->global->date->datetime_ymd_format . ' ' . Language::get()->global->date->datetime_his_format;
                break;

            case 2:
                return Language::get()->global->date->datetime_readable_format;
                break;

            case 3:
                return Language::get()->global->date->datetime_his_format;
                break;

        }

    }

    /* Helper to generate start_date and end_date for datepicker */
    public static function get_start_end_dates($start_date, $end_date) {

        $return = new \StdClass();

        /* Date selection for the notification logs */
        if($start_date && $end_date && (self::validate($start_date, 'Y-m-d') || self::validate($start_date, 'Y-m-d H:i:s')) && (self::validate($end_date, 'Y-m-d') || self::validate($end_date, 'Y-m-d H:i:s'))) {
            $return->start_date = $start_date;
            $return->start_date_query = (new \DateTime($start_date))->format('Y-m-d H:i:s');
            $return->end_date_query = (new \DateTime($end_date))->modify('+1 day')->format('Y-m-d H:i:s');
            $return->end_date = $end_date;
        } else {
            $return->start_date_query = (new \DateTime())->modify('-30 day')->format('Y-m-d H:i:s');
            $return->start_date = (new \DateTime())->modify('-30 day')->format('Y-m-d');
            $return->end_date_query = (new \DateTime())->modify('+1 day')->format('Y-m-d H:i:s');
            $return->end_date = (new \DateTime())->modify('+1 day')->format('Y-m-d');
        }

        $return->input_date_range = $return->start_date . ',' . $return->end_date;

        return $return;
    }

    /* Helper to have the timeago from one point to now */
    public static function get_timeago($date) {

        $estimate_time = time() - (new \DateTime($date))->getTimestamp();

        if($estimate_time < 1) {
            return Language::get()->global->date->now;
        }

        $condition = [
            12 * 30 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  'second'
        ];

        foreach($condition as $secs => $str) {
            $d = $estimate_time / $secs;

            if($d >= 1) {
                $r = round($d);

                /* Determine the language string needed */
                $language_string_time = $r > 1 ? Language::get()->global->date->{$str . 's'} : Language::get()->global->date->{$str};

                return sprintf(
                    Language::get()->global->date->time_ago,
                    $r,
                    $language_string_time
                );
            }
        }
    }

    /* Helper to have the time left from now to one point in time */
    public static function get_time_until($date) {

        $estimate_time = (new \DateTime($date))->getTimestamp() - time();

        if($estimate_time < 1) {
            return Language::get()->global->date->now;
        }

        $condition = [
            12 * 30 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  'second'
        ];

        foreach($condition as $secs => $str) {
            $d = $estimate_time / $secs;

            if($d >= 1) {
                $r = round($d);

                /* Determine the language string needed */
                $language_string_time = $r > 1 ? Language::get()->global->date->{$str . 's'} : Language::get()->global->date->{$str};

                return sprintf(
                    Language::get()->global->date->time_until,
                    $r,
                    $language_string_time
                );
            }
        }
    }
}
