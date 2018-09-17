<?php
namespace Core;

class SessionManager {
    protected static $session_name;
    protected static function start_session() {
        session_start([
            'name' => self::$session_name . '_session',
            // 'save_path' => self::$savepath
        ]);
    }
    public static function sessionStart($name, $limit = 0, $path = '/', $domain = null, $secure = null)
    // , $savepath = '/')
    {
    // Set the cookie name
        session_name($name . '_session');

    // Set SSL level
        $https = isset($secure) ? $secure : isset($_SERVER['HTTPS']);

    // Set session cookie options
    // session_set_cookie_params ( int $lifetime [, string $path [, string $domain [, bool $secure = FALSE [, bool $httponly = FALSE ]]]] )
        session_set_cookie_params($limit, $path, $domain, $https, true);
        self::$session_name = $name;
        // self::$savepath = $savepath;
        self::start_session();

    // Make sure the session hasn't expired, and destroy it if it has
        if(self::validateSession())
        {
        // Check to see if the session is new or a hijacking attempt
            if(!self::preventHijacking())
            {
            // Reset session data and regenerate id
                $_SESSION = array();
                $_SESSION['IPaddress'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
                self::regenerateSession();

        // Give a 5% chance of the session id changing on any request
            }elseif(rand(1, 100) <= 5){
                self::regenerateSession();
            }
        }else{
            $_SESSION = array();
            session_destroy();
            self::start_session();
        }
    }
    protected static function validateSession()
    {
        if( isset($_SESSION['OBSOLETE']) && !isset($_SESSION['EXPIRES']) )
            return false;

        if(isset($_SESSION['EXPIRES']) && $_SESSION['EXPIRES'] < time())
            return false;

        return true;
    }
    public static function regenerateSession()
    {
    // If this session is obsolete it means there already is a new id
        if(isset($_SESSION['OBSOLETE']) && $_SESSION['OBSOLETE'] == true)
            return;

    // Set current session to expire in 10 seconds
        $_SESSION['OBSOLETE'] = true;
        $_SESSION['EXPIRES'] = time() + 10;

    // Create new session without destroying the old one
        session_regenerate_id(false);

    // Grab current session ID and close both sessions to allow other scripts to use them
        $newSession = session_id();
        session_write_close();

    // Set session ID to the new one, and start it back up again
        session_id($newSession);
        self::start_session();

    // Now we unset the obsolete and expiration values for the session we want to keep
        unset($_SESSION['OBSOLETE']);
        unset($_SESSION['EXPIRES']);
    }
    protected static function preventHijacking()
    {
        if(!isset($_SESSION['IPaddress']) || !isset($_SESSION['userAgent']))
            return false;

        if ($_SESSION['IPaddress'] != $_SERVER['REMOTE_ADDR'])
            return false;

        if( $_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT'])
            return false;

        return true;
    }
}
