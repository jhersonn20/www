<?php
if (! defined ( 'BASEPATH' ))
    exit ( 'No direct script access allowed' );

class Router extends CI_Router {
    
    var $_route = array ();
    
    function MY_Router() {
        parent::CI_Router ();
    }
    
    function _set_routing() {
        parent::_set_routing ();
        
        // re-routed url
        if ($this->uri->rsegments != $this->segments) {
            if (count ( $this->uri->rsegments ) > 0) {
                array_unshift ( $this->uri->rsegments, $this->_route ['directory'] );
            }
        }
    }
    
    function _build_sub_route($segments) {
        
        $route = array ();
        
        // Recurse through the sub directory route finding the directory path, controller and method
        $this->_recurse_sub_route ( $segments );
        
        // Build the route to the directory, controller, method with parameters
        $route [0] = empty ( $this->_route ['directory'] ) ? null : implode ( $this->_route ['directory'], DIRECTORY_SEPARATOR );
        $route = @array_merge ( $route, $this->_route ['controller'] );
        $route = @array_merge ( $route, $this->_route ['parameter'] );
        
        $this->segments = $route;
        
        return $route;
    }
    
    function _recurse_sub_route($segments) {
        
        // Find the all directories and files to be routed
        foreach ( $segments as $k => $segment ) {
            
            $directory = @implode ( $this->_route ['directory'], DIRECTORY_SEPARATOR );
            
            // Find all directories
            if (is_dir ( APPPATH . 'controllers/' . $directory . DIRECTORY_SEPARATOR . $segment )) {
                $this->_route ['directory'] [$k] = $segment;
            }
            
            // Find all controllers
            if (is_file ( APPPATH . 'controllers/' . $directory . DIRECTORY_SEPARATOR . $segment . EXT )) {
                $this->_route ['controller'] [$k] = $segment;
            }
        
        }
        
        // Find the controller in route
        $controller = @array_slice ( $this->_route ['controller'], - 1, 1, true );
        // Determine the parameters after controller
        $this->_route ['parameter'] = @array_slice ( $segments, key ( $controller ) + 1 );
        
        // Remove controller binding from directory route
        if (@array_key_exists ( key ( $controller ), $this->_route ['directory'] )) {
            unset ( $this->_route ['directory'] [key ( $controller )] );
        }
        
        // Remove any directories from controller route
        if (! empty ( $this->_route ['directory'] )) {
            $this->_route ['controller'] = @array_diff ( $this->_route ['controller'], $this->_route ['directory'] );
        }
    }
    
    function _validate_request($segments) {
        
        $segments = $this->_build_sub_route ( $segments );
        
        // Is the controller in a sub-folder?
        if (is_dir ( APPPATH . 'controllers/' . $segments [0] )) {
            
            // Set the directory and remove it from the segment array
            $this->set_directory ( $segments [0] );
            $segments = @array_slice ( $segments, 1 );
            
            if (count ( $segments ) > 0) {
                
                // Does the requested controller exist in the sub-folder?
                if (! file_exists ( APPPATH . 'controllers/' . $this->fetch_directory () . $segments [0] . EXT )) {
                    show_404 ();
                }
            } else {
                $this->set_class ( $this->default_controller );
                $this->set_method ( 'index' );
                
                // Does the default controller exist in the sub-folder?
                if (! file_exists ( APPPATH . 'controllers/' . $this->fetch_directory () . $this->default_controller . EXT )) {
                    $this->directory = '';
                    return array ();
                }
            
            }
            
            return $segments;
        }
        
        // Can't find the requested controller...
        show_404 ();
    }
}

?>  