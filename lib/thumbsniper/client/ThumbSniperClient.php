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

require_once('vendor/autoload.php');



/**
 * Class ThumbSniperClient
 */
class ThumbSniperClient
{
    /**
     *
     */
    function __construct()
    {
        if(ThumbSniperClientSettings::getTimezone()) {
            date_default_timezone_set(ThumbSniperClientSettings::getTimezone());
        }

        if(ThumbSniperClientSettings::getErrorReporting()) {
            ini_set('error_reporting', ThumbSniperClientSettings::getErrorReporting());
        }

        if(ThumbSniperClientSettings::getDisplayErrors()) {
            ini_set('display_errors', ThumbSniperClientSettings::getDisplayErrors());
        }
    }


    /**
     * @param $str
     * @return string
     */
    private function addSlash($str)
    {
        return substr($str, -1) === '/' ? '' : '/';
    }


    /**
     * @param $url
     * @return bool
     */
    private function urlContainsApiKey($url)
    {
        if (ThumbSniperClientSettings::getApiKey() && strpos($url, ThumbSniperClientSettings::getApiKey())) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * @param $url
     * @param $width
     * @param $effect
     * @param $apiKey
     * @return string
     */
    private function generateApiUrl($url, $width, $effect, $apiKey)
    {
        $apiUrl = ThumbSniperClientSettings::getApiUrl();

        $apiUrl .= $this->addSlash($apiUrl) . 'v' . ThumbSniperClientSettings::getApiVersion() . '/thumbnail/';

        if ($apiKey) {
            $apiUrl .= $this->addSlash($apiUrl) . $apiKey . '/';
        }

        $apiUrl .= $this->addSlash($apiUrl) . $width . '/';
        $apiUrl .= $this->addSlash($apiUrl) . $effect . '/';
        $apiUrl .= $this->addSlash($apiUrl) . '?url=' . $url;

        return $apiUrl;
    }



    private function getCurrentPageUrl()
    {
        $url = 'http';

        if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
            $url .= "s";
        }

        $url .= "://";

        if($_SERVER["SERVER_PORT"] != "80") {
            $url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }

        return $url;
    }

    /**
     * @param $url
     * @return mixed|null
     */
    private function sendHeaderRequest($url)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_REFERER, $this->getCurrentPageUrl());
        curl_exec($ch);

        $response = curl_getinfo($ch);
        curl_close($ch);

        $resultUrl = null;

        switch ($response['http_code']) {
            case 200:
                $resultUrl = $response['url'];
                break;

            case 307:
                $resultUrl = $this->sendHeaderRequest($response['redirect_url']);
                break;
        }

        return $resultUrl;
    }


    /**
     * @param $url
     * @param $width
     * @param $effect
     * @return mixed|null
     */
    public function getThumbnailUrl($url, $width, $effect)
    {
        $apiKey = ThumbSniperClientSettings::getApiKey();

        $apiUrl = $this->generateApiUrl($url, $width, $effect, $apiKey);

        if($apiKey !== null) {
            $thumbnailUrl = $this->sendHeaderRequest($apiUrl);
        }else {
            $thumbnailUrl = $apiUrl;
        }

        if ($this->urlContainsApiKey($thumbnailUrl)) {
            return null;
        } else {
            return $thumbnailUrl;
        }
    }
}
