<?php

/*
 * Copyright (C) 2015  Thomas Schulte <thomas@cupracer.de>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

namespace ThumbSniper\client;


/**
 * Class Settings
 */
class ThumbSniperClientSettings
{
    /**
     * @var
     */
    private static $timezone;

    /**
     * @var string
     */
    private static $apiUrl;
    /**
     * @var int
     */
    private static $apiVersion = 3;
    /**
     * @var
     */
    private static $apiKey;
    /**
     * @var array
     */
    private static $validContentTypes = array('image/png', 'image/jpeg');
    /**
     * @var int
     */
    private static $errorReporting = E_ALL;
    /**
     * @var
     */
    private static $displayErrors = false;

    /**
     * @return mixed
     */
    public static function getApiKey()
    {
        return self::$apiKey;
    }

    /**
     * @return string
     */
    public static function getApiUrl()
    {
        return self::$apiUrl;
    }

    /**
     * @param string $apiUrl
     */
    public static function setApiUrl($apiUrl)
    {
        self::$apiUrl = $apiUrl;
    }

    /**
     * @return int
     */
    public static function getApiVersion()
    {
        return self::$apiVersion;
    }

    /**
     * @param int $apiVersion
     */
    public static function setApiVersion($apiVersion)
    {
        self::$apiVersion = $apiVersion;
    }

    /**
     * @return mixed
     */
    public static function getTimezone()
    {
        return self::$timezone;
    }

    /**
     * @param mixed $apiKey
     */
    public static function setApiKey($apiKey)
    {
        self::$apiKey = $apiKey;
    }

    /**
     * @param mixed $timezone
     */
    public static function setTimezone($timezone)
    {
        self::$timezone = $timezone;
    }

    /**
     * @return mixed
     */
    public static function getValidContentTypes()
    {
        return self::$validContentTypes;
    }

    /**
     * @return int
     */
    public static function getErrorReporting()
    {
        return self::$errorReporting;
    }

    /**
     * @param int $errorReporting
     */
    public static function setErrorReporting($errorReporting)
    {
        self::$errorReporting = $errorReporting;
    }

    /**
     * @return mixed
     */
    public static function getDisplayErrors()
    {
        return self::$displayErrors;
    }

    /**
     * @param mixed $displayErrors
     */
    public static function setDisplayErrors($displayErrors)
    {
        self::$displayErrors = $displayErrors;
    }
}
