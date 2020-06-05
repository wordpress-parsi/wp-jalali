<?php

/*
 * jdate
 * convert gregorian datetime to persian datetime
 *
 * @param mixed $input
 * @param string $datetime
 * @param string $lang
 *
 * @return string
 */
function jdate($input, $datetime = 'now', $lang = 'per') {
	return parsidate($input, $datetime, $lang);
}

/**
 * jalali_to_gregorian
 * convert persian datetime to gregorian datetime
 *
 * @param mixed $input
 * @param mixed $datetime
 *
 * @return datetime
 */
function jalali_to_gregorian($input, $datetime) {
	return gregdate($input, $datetime);
}

/*
 * gregorian_to_jalali
 * convert gregorian datetime to persian datetime
 *
 * @param mixed $input
 * @param string $datetime
 * @param string $lang
 *
 * @return string
 */
function gregorian_to_jalali($input, $datetime = 'now', $lang = 'en') {
	return parsidate($input, $datetime, $lang);
}