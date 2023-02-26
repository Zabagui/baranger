<?php
 /*
 * PasswordType
 * Returns the current preferred encryption method name
 */

function PasswordType()
{
    global $tngconfig;

    static $type_name;    // the password encryption name. Save for faster future calls

    if (!isset($type_name)) { // just do this once
		// start with the default if type not set
        if( !isset($tngconfig['password_type']) ) $tngconfig['password_type'] = "";
        $type_name = $tngconfig['password_type'] && PasswordTypeList($tngconfig['password_type']) ? $tngconfig['password_type'] : PasswordTypeList('default');
    }
    return $type_name;
}

/*
 * PasswordEncode
 * Returns the encoded value of the given string $str.  The type of encryption used is given by the encryption method $name
 * If only $str is given, then the encryption method specified by PasswordType() will be used
 * If the encryption type name is not a supported encryption method, then the function returns false
*/

function PasswordEncode($str, $name=null) {

    // make sure $name is valid
    if ($name === null) {
        $name = PasswordType();
    } elseif (!PasswordTypeList($name)){
        return false;
    }

    switch ($name) {
        case "none":
                return $str;
                break;
        case 'md5':
                return md5($str);
                break;
        case 'sha1':
                return sha1($str);
                break;
        case 'phpass':
                global $pwd_hasher;
                if ( empty($pwd_hasher) ) {
                    $pwd_hasher = phpassInit(8, TRUE);  // DEFAULT: use the portable hash from phpasss
                }                                       // NOTE: this may need to be extended to support variations by different CMS's
                return $pwd_hasher->HashPassword($str);
                break;
        default:
                // if it exists, the hash() function contains all the encryption types, so use it for all the rest
                return ( function_exists('hash') ) ? hash($name,$str) : false;
    }

    return false;  // error, something went wrong if we got this far
}


/*
 * PasswordCheck
 * Takes a password string $str, an encoded string $hash, and optionally the encryption method name $name, and returns:
 * 0 if no match or an error
 * 1 if a match
 * 2 if a match but the hash type is not the same as PasswordType().
 *    This can then be used as a flag to update a password to the new encoding method specified by PasswordType().
 *    Since a plain text version of the password was given for the check, this same plain text password can be used to
 *    generate a new encoded password in the latest format using the PasswordEncode() function.
 * If no  encryption method name $name is given, then the encryption method specified by PasswordType() will be used.
 * If the encryption method name $name is 'encrypted', then it is assumed the password string $str is already encrypted.
*/

function PasswordCheck($str, $hash, $name=null){

    if ($name=='encrypted') {
        // $str is already encrypted, so just check to see if they match
        return (strcmp($str, $hash) == 0 ) ? 1 : 0;
    } else {
        // make sure $name is valid
        if ($name == null || !$name) {
            $name = PasswordType();
        } elseif (!PasswordTypeList($name)){
            return 0;
        }
        if ($name == 'phpass'){
            // use the phpass functions
            global $pwd_hasher;
            if ( empty($pwd_hasher) ) {
                $pwd_hasher = phpassInit(8, TRUE); // DEFAULT: use the portable hash from phpasss
            }                                      // NOTE: this may need to be extended to support variations by different CMS's
            $check = $pwd_hasher->CheckPassword($str, $hash);
            
        } else {
            // everything else
            $check = ($hash == PasswordEncode($str, $name) ) ? true : false;
        } 

        if ($check) {
            return ( $name == PasswordType() ) ? 1 : 2; // have a match, same encryption as the preferred?
        } else {
            return 0;  // no match
        }
    }
}


/*
 * PasswordTypeList
 * Valid password encryption method values
 * Called without any arguments, will return an array of encryption method names
 * Called with one parameter will return true if the parameter given is a valid password encryption method name.
 * Called with one parameter named 'default' will return 'md5'.
 *
 * The second parameter $Force_No_Hash is only used for testing purposes.  A true value will simulate not having the hash() function
 *
 * Note: It is easy to extend this to other encryption methods. See php function hash_algos() for a full list supported by hash()
 *       Additional names must match the names from hash_algos()
 */

function PasswordTypeList($ReturnPart=null, $Force_No_Hash=false)
{
    global $cms;
    static $type_list;  // save for faster future calls

    if (!isset($type_list)) { // just do this once

        $type_list[] = 'md5'; // always have at least md5

        if (function_exists('sha1')) {
            $type_list[] = 'sha1';
        }

        if (function_exists('hash') && !$Force_No_Hash) {
            $type_list[] = 'sha256';
            $type_list[] = 'sha384';
            $type_list[] = 'sha512';
            // Note: Others can be added here
        }

        $type_list[] = 'phpass';
        $type_list[] = 'none';
    }

    if ($ReturnPart === null) {
        return $type_list;  // give the whole list
    }

    if ($ReturnPart === '' || $ReturnPart === 'default') {
        return 'md5';  // give the default
    }

    // If still here, then return true if in the list, false if not
    return in_array($ReturnPart, $type_list);

}

global $pwd_hasher;

function phpassInit($iteration_count_log2=8, $portable_hashes=TRUE){
    global $cms, $pwd_hasher;
    require_once($cms['tngpath'] . "pwdlib-phpass.php");
    $pwd_hasher = new PasswordHash($iteration_count_log2, $portable_hashes); // By default, use the portable hash from phpass
    return $pwd_hasher;
}
?>