<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

// include native CI_Validation class file
include_once(BASEPATH.'libraries/Validation.php');

/**
 * MY_Validation Class, extends CI_Validation
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Validation
 */
class MY_Validation extends CI_Validation {

    /**
     * Constructor
     *
     * @access    public
     */
    public function MY_Validation()
    {
        parent::CI_Validation();
        log_message('debug', "MY_Validation Class Initialized");
    }

    // --------------------------------------------------------------------


    /**
    * Overwrites CI's native validation set_select method to work
    * with arrays.
    *
    * @access   public
    * @param    string
    * @param    string
    * @return   string
    * @author   r.vadivelan / hivelan [.at.] gmail [.dot.] com
    * @link     http://codeigniter.com/forums/viewthread/73012/
    */
    public function set_select($field = '', $value = '')
    {
        if ($field == '' OR $value == '' OR  ! isset($_POST[$field]))
        {
            return '';
        }

        if(is_array($_POST[$field])) {
            if(in_array($value,$_POST[$field])) {
                return ' selected="selected"';
            }
        } elseif ($_POST[$field] == $value) {
            return ' selected="selected"';
        }

    }

    // --------------------------------------------------------------------


    /**
    * Overwrites CI's native validation set_checkbox method to work
    * with arrays.
    *
    * @access   public
    * @param    string
    * @param    string
    * @return   string
    * @author   r.vadivelan / hivelan [.at.] gmail [.dot.] com
    * @link     http://codeigniter.com/forums/viewthread/73012/
    */
    public function set_checkbox($field = '', $value = '')
    {
        if ($field == '' OR $value == '' OR  ! isset($_POST[$field]))
        {
            return '';
        }

        if(is_array($_POST[$field])) {
            if(in_array($value,$_POST[$field])) {
                return ' checked="checked"';
            }
        } elseif ($_POST[$field] == $value) {
            return ' checked="checked"';
        }
    }

    // --------------------------------------------------------------------


    /**
    * Overwrites CI's native validation prep_for_form method to work
    * with arrays. Takes a string or an array and returns the same.
    *
    * @access   public
    * @param    mixed
    * @return   mixed
    * @author   r.vadivelan / hivelan [.at.] gmail [.dot.] com
    * @link     http://codeigniter.com/forums/viewthread/73012/
    */
    public function prep_for_form($data = '')
    {
        if (is_array($data))
        {
            foreach ($data as $key => $val)
            {
                $data[$key] = $this->prep_for_form($val);
            }
        }

        if ($this->_safe_form_data == FALSE OR $data == '')
        {
            return $data;
        }

        if(is_array($data)) {
            return $data;
        } else {
            return str_replace(array("'", '"', '<', '>'), array("&#39;", "&quot;", '<', '>'), stripslashes($data));
        }
    }

    // --------------------------------------------------------------------


    /**
     * native php function caller
     *
     * This function calls native php functions for each values submitted from the form
     *
     * @access  public
     * @param   string
     * @return  string
     * @author  r.vadivelan / hivelan [.at.] gmail [.dot.] com
     * @link    http://codeigniter.com/forums/viewthread/73012/
     */
    public function php_func_caller($rule, $data = '')
    {
        if (is_array($data))
        {
            foreach ($data as $key => $val)
            {
                $data[$key] = $this->php_func_caller($rule,$val);
            }
        }

        if ($data == '')
        {
            return $data;
        }

        if(is_array($data)) {
            return $data;
        } else {
            return $rule($data);
        }
    }

    // --------------------------------------------------------------------

}
// END MY_Validation Class

?> 