<?php
return array(
    // set your paypal credential
    'client_id' => 'AWWyqggk46QjFembOuLIWDWmkYqoSv2uvtPZxnMju1YuA8-UuviZxk40IsOpMS98Y2DwSkYGxMUfmbXR',
    'secret' => 'EEdhzWeqv6DY2Lc9znBoBnkN3VykQ-KRNWtUtRxzEQWnM5fJs7kNb4jt3YF0ZAo83qFbJ0Z7p8TC5ouz',

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);