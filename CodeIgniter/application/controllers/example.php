<?php
/**
 * Class Example
 *
 * This class is just to demonstrate how to use my CRUD model
 * it does not perform any security checks, this class should not be
 * deployed on a public server.  I do no validation, and no checking
 * of parameters... I leave that to you to implement...
 */
class Example extends Controller {
    /**
     * function Example()
     *
     * This is the initializer function. It calls the Parent
     * class, and also loads the url helper and turns on the
     * codeigniter profileer.
     */
    function Example() {
        // Call the parent class
        parent::Controller();
        // Load the URL Helper
        $this->load->helper('url');
        // Turn on the profiler
        $this->output->enable_profiler(TRUE);
    }
    /**
     * function create_table()
     *
     * This function builds the table structure for the demonstration.
     * It is not part of the CRUD model.
     */
    function create_table() {
        /** this method would normally be in a model.
         * however to keep the model clean for distrobution
         * I have chosen to place it here.  As this
         * will not be used in a production environment.
         */
        // Load Database Forge to contstruct table
        $this->load->dbforge();
        // Build the field types
        $fields = array('blog_id' => array('type' => 'INT', 'constraint' => 12, 'unsigned' => TRUE, 'auto_increment' => TRUE), 'date' => array('type' => 'INT', 'constraint' => 12, 'null' => FALSE, 'unsigned' => TRUE), 'title' => array('type' => 'VARCHAR', 'constraint' => '100', 'null' => FALSE), 'content' => array('type' => 'TEXT', 'null' => TRUE));
        // Assemble all the fields
        $this->dbforge->add_field($fields, TRUE);
        // This creates the pirmary key of fileID
        $this->dbforge->add_key('blog_id', TRUE);
        // This creates the speicified table with the IF NOT EXIST parameter
        $this->dbforge->create_table('blog');
    }
    /**
     * function _random_title()
     *
     * This function just generates a random text to be used
     * as copy in our blog... If you don't like what they say..
     * You can change and add as many as you like..
     *
     * THIS IS NOT PART OF THE CRUD MODEL. I just had to have
     * a way to get data, and didn't feel like doing form processing for
     * the demonstration.
     */
    function _random_title() {
        $title_list = array('The cat ate my hat.', 'The mouse ate my cat.', 'The mouse is scary!', 'There once was an old lady who swallowed a fly.', 'I don\'t know why she swallowed the fly.', 'Perhpas she\'ll dye?', 'She swallowed a spider to catch the fly.', 'She swallowed lizard to catch the spider.', 'She swallowed a cat to catch the lizard.', 'She swallowed a dog to catch the cat.', 'She swallowed a dog catcher to catch the dog.', 'This is obsurde she swallowed a herd.', 'I think she died, or at least be came a good urban ledgend.');
        // Select a random key...
        $rand_keys = array_rand($title_list, 1);
        // Return the random key.
        return $title_list[$rand_keys];
    }
    /**
     * function create()
     *
     * This is the controller function create... this is an example
     * of how you could implement the Create in CRUD.
     */
    function create() {
        // -----------------------------------------------------------
        // Normally you would do the whole form validation thing
        // here... but i'm not setting all that up... I'm showing you
        // how to use my crud class... so I am pre-building some data
        // representing what might come from a form (that is valid)
        // -----------------------------------------------------------
        // These vars represent data that might come from a user...
        // via a form..
        $date = time();
        $title = $this->_random_title(); // Could come from a post or file or....
        $content = 'Some Ipsom latin copy here....'; // Could come from a post a file or...
        // Load the model
        // I do this in every function... but this could just as
        // easily be moved to the initializer function
        $this->load->model('crud');
        // This is how you tell the CRUD model what table to use...
        // I do this in every function... but this could just as
        // easily be moved to the initializer function so that you are not repeating code.
        $this->crud->use_table('blog');
        // Ussually you would want to make sure an entry is uniqe...
        // You don't have to do this but I found it useful...
        // The array could contain as many database feilds as you like... here we
        // only needed one.
        if ($this->crud->is_entry_unique(array('title' => $title))) {
            // We collect that data and put it into an array.
            // notice the array keys are equal to the database
            // table fields... This could also be done inline
            // like this:
            // $this->crud->create(array('date' => $date, 'title' => $title, 'content' => $content));
            // I generate a seperate variable I think it is cleaner code...
            $db_input = array('date' => $date, 'title' => $title, 'content' => $content);
            // Enter the database entry and make sure it worked...
            // Create returns boolean TRUE/FALSE values about it's success.
            if ($this->crud->create($db_input)) {
                // Tell the user it worked.
                $this->index('New entry created');
            } else {
                // Tell the user there has been an error
                // Call the index which diplays everything.
                $this->index('There has been an error check your logs.');
            }
        } else {
            // Tell them there was a duplicate and to try agian...
            // Call the index which diplays everything.
            $this->index('Duplicate entry detected! Data was not inserted.');
        }
    }
    /**
     * function retrieve($blog_id)
     *
     * This function uses the Retrieve in the CRUD model.
     */
    function retrieve($blog_id = 0) {
        // Load the model
        // I do this in every function... but this could just as
        // easily be moved to the initializer function
        $this->load->model('crud');
        // This is how you tell the CRUD model what table to use...
        // I do this in every function... but this could just as
        // easily be moved to the initializer function so that you are not repeating code.
        $this->crud->use_table('blog');
        // This is the array used to deterine WHAT data gets pulled from the database.
        // This array can contain as many criteria as you wish. The array
        // Keys MUST match database table fields.
        $criteria = array('blog_id' => $blog_id);
        // The CRUD retrieve returns the standard Codeigniter object, so you
        // would handle it exactly the same as a Codeigniter active database
        // Query.
        // -----------------------------------------------------------------
        // retrieve($criteria = array(), $limit = 0, $offset = 0, $order = array())
        // A limit of Zero (0) means NO LIMIT
        $query = $this->crud->retrieve($criteria, 1);
        // If there are results...
        if ($query->num_rows > 0) {
            // Go through the results.
            foreach ($query->result_array() as $row) {
                // Tell the user the results.
                $message = 'We have retrieved a message titled "' . $row['title'] . '".';
            }
        } else {
            // Tell the user there were no results.
            $message = 'There were no results for you query. Please try again with different criteria.';
        }
        // Call the index which diplays everything.
        $this->index($message);
    }
    /**
     * function update($blog_id)
     *
     * This function uses the UPDATE function of CRUD.
     */
    function update($blog_id = 0) {
        // I dont want to do form valiation... so I will
        // simply update the time stamp to show you how to update fields.
        // These vars represent data that might come from a user...
        // via a form..
        $date = time();
        $content = 'Updated content... Yay!';
        // Load the model
        $this->load->model('crud');
        // I assume you used the create function first.
        $this->crud->use_table('blog');
        // We collect the "new" data and put it into an array.
        // notice the array keys are equal to the database
        // table fields...
        $db_input = array('date' => $date, 'content' => $content);
        // then we chose the criteria of what database entry will
        // get modified.  You can have as many criteria as you like
        // as long as they are valid database table keys. In this
        // we only needed one..
        $criteria = array('blog_id' => $blog_id);
        // Enter the database entry and make sure it worked...
        // the update function returns false if there was an error
        // and it returns the codeigniter resource if successful.
        // normally we do not need the object... but it is there if you need it.
        // Here are the function paramaters.  (they can be found in greater detail
        // in the crud model file.)
        // -----------------------------------------------------------------
        // update($criteria = array(), $data_in = array(), $limit = 0, $offset = 0, $order = array())
        if ($this->crud->update($criteria, $db_input) === FALSE) {
            // Tell the user there has been an error
            $this->index('There has been an error check your logs.');
        } else {
            // Tell the user it worked.
            $this->index('The blog entry with the ID of:' . $blog_id . ' has been updated.');
        }
    }
    /**
     * function $delete($blog_id)
     *
     * This function uses the DELETE function of CRUD.
     */
    function delete($blog_id = 0) {
        // Load the model
        $this->load->model('crud');
        // I assume you used the create function first.
        $this->crud->use_table('blog');
        // Chose the critireia to make the deletion.
        // Remember DELETE can remove MULTIPLE ENTIES in a SINGLE QUERY.
        // So be selective. and specify a limit if you can.
        $criteria = array('blog_id' => $blog_id);
        // delete the database entry and make sure it worked...
        // here are the parameters for delete:
        //------------------------------------------------------------------
        // delete($criteria = array(), $limit = 0, $offset = 0, $order = array())
        if ($this->crud->delete($criteria, 1) === FALSE) {
            // Tell the user there has been an error
            $this->index('There has been an error check your logs.');
        } else {
            // Tell the user it worked.
            $this->index('The blog entry with the ID of:' . $blog_id . ' has been deleted.');
        }
    }
    /**
     * function index($message)
     *
     * This function simply takes all the pieces and displayes them.
     * Normaly  you would have your own code do this.
     */
    function index($message = '') {
        // Prep the message to go to the view
        $data['message'] = $message;
        // Load the model
        $this->load->model('crud');
        // I assume you used the create function first.
        $this->crud->use_table('blog');
        // Count the number of entries.
        $data['total'] = $this->crud->count();
        // retrieve($criteria = array(), $limit = 0, $offset = 0, $order = array())
        $query = $this->crud->retrieve(array('blog_id >=' => 0), 0, 0, array('title' => 'asc'));
        if ($query->num_rows > 0) {
            foreach ($query->result_array() as $row) {
                $table_list[] = $row;
            }
            $data['table_list'] = $table_list;
        } else {
            $data['table_list'] = '';
        }
        // Load the view to be seen.
        $this->load->view('index.php', $data);
    }
}
/* End of file example.php */
/* Location: ./system/application/controllers/example.php */
