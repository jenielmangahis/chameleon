<?php
/*
 * Copyright 2010 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

global $apiConfig;
$apiConfig = array(
    // True if objects should be returned by the service classes.
    // False if associative arrays should be returned (default behavior).
    'use_objects' => false,
  
    // The application_name is included in the User-Agent HTTP header.
    'application_name' => 'Demo GoSocialCMS',

    // OAuth2 Settings, you can get these keys at https://code.google.com/apis/console
  //  'oauth2_client_id' => '1010097023889.apps.googleusercontent.com',
   // 'oauth2_client_secret' => 'OCN3h3-HChiWQ-B79VAtmsDn',
    'oauth2_client_id' => '1010097023889-310gan41pt77me1j3nco316to81r5qoo.apps.googleusercontent.com',
    'oauth2_client_secret' => '6zbeZ06YijkLSxjbzr_76sM-',
    'oauth2_redirect_uri' => 'http://www.gocitiescms.com/companies/googleplus_login',

    // The developer key, you get this at https://code.google.com/apis/console
    'developer_key' => '',
  
    // Site name to show in the Google's OAuth 1 authentication screen.
    'site_name' => 'http://www.gocitiescms.com',

    // Which Authentication, Storage and HTTP IO classes to use.
    'authClass'    => 'Google_OAuth2',
    'ioClass'      => 'Google_CurlIO',
    'cacheClass'   => 'Google_FileCache',

    // Don't change these unless you're working against a special development or testing environment.
    'basePath' => 'https://www.googleapis.com',

    // IO Class dependent configuration, you only have to configure the values
    // for the class that was configured as the ioClass above
    'ioFileCache_directory'  =>
        (function_exists('sys_get_temp_dir') ?
            sys_get_temp_dir() . '/Google_Client' :
        '/tmp/Google_Client'),

    // Definition of service specific values like scopes, oauth token URLs, etc
		//https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile
    'services' => array(
      'plus' => array('scope' => array('https://www.googleapis.com/auth/plus.me','https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile'))
    )
);