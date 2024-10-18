<?php 
class Online_Donation_List extends WP_List_Table {

    function __construct() {
        parent::__construct([
            'singular' => __('Item', 'donatelife'),
            'plural'   => __('Items', 'donatelife'),
            'ajax'     => false
        ]);
    }

    function get_columns() {
        $columns = [
            'cb'       => '<input type="checkbox" />', // For bulk actions
            'id'       => __('ID', 'donatelife'),
            'odname'       => __('Name', 'donatelife'),
            'oddatetime'     => __('Date & Time', 'donatelife'),
            'odamount'    => __('Donation Amount', 'donatelife'),
            'odstatus'     => __('Donation Status', 'donatelife'),
            'odmobile'     => __('Mobile No', 'donatelife'),
            'view'  => __('View','donatelife'),
            'actions' => __('Actions','donatelife')
        ];
        return $columns;
    }

    function prepare_items() {
        $data = $this->table_data(); // Fetch your custom data

        $columns = $this->get_columns();
        $hidden = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [$columns, $hidden, $sortable];
        $this->items = $data;

        $this->process_bulk_action(); // Process bulk actions (delete)


        // Handle pagination
        $per_page = 20;
        $current_page = $this->get_pagenum();
        $total_items = count($data);

        $this->set_pagination_args([
            'total_items' => $total_items,
            'per_page'    => $per_page,
        ]);

        $data = array_slice($data, (($current_page - 1) * $per_page), $per_page);
        $this->items = $data;
    }

    function column_cb($item) {
        return sprintf('<input type="checkbox" name="id[]" value="%s" />', $item['id']);
    }

    function column_default($item, $column_name) {
        switch ($column_name) {
            case 'id':
            case 'oddatetime':
            case 'odname':
            case 'odamount':
            case 'odstatus':
            case 'odmobile':
                return $item[$column_name];
            case 'actions':
                return $this->row_actions_output($item);
            case 'view':
                return $this->row_view_action_output($item);
            default:
                return print_r($item, true); //Show the whole array for debugging purposes
        }
    }

     // Create delete link for each row in the "Actions" column
     private function row_actions_output($item) {
        $delete_url = esc_url(add_query_arg(array(
            'page'    => $_REQUEST['page'],
            'action'  => 'delete',
            'id'      => $item['id'],
        )));

        return sprintf(
            '<a href="%s" onclick="return confirm(\'Are you sure you want to delete this item?\')">Delete</a>',
            $delete_url
        );
    }

     // Create view action
     private function row_view_action_output($item) {
      /*   $view_popup = esc_url(add_query_arg(array(
            'page'    => $_REQUEST['page'],
            'action'  => 'delete',
            'id'      => $item['id'],
        ))); */

        return sprintf(
            '<a href="#" data-id="%s" class="view-popup" data-toggle="modal" data-target="#myModal">View</a>',
            $item['id']
        );
    }

    function get_sortable_columns() {
        $sortable_columns = [
            'id'   => ['id', true],
            'odname' => ['odname',true],
            'oddatetime' => ['oddatetime', false]
            
        ];
        return $sortable_columns;
    }   
    
     // Bulk actions (delete action)
     function get_bulk_actions() {
        $actions = array(
            'bulk-delete' => 'Delete'
        );
        return $actions;
    }

    // Process bulk action
    public function process_bulk_action() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'online_donation_master';

        // Check for the delete action
        if ('delete' === $this->current_action()) {
            $id = absint($_GET['id']); // Get the ID from URL
            $wpdb->update($table_name, ['is_trash' => 1], ['id' => $id]);
            wp_redirect(esc_url(remove_query_arg(array('action', 'id'))));
            exit;
        }

        // Process bulk delete action
        if ((isset($_POST['action']) && $_POST['action'] == 'bulk-delete') ||
            (isset($_POST['action2']) && $_POST['action2'] == 'bulk-delete')) {
            
            $delete_ids = esc_sql($_REQUEST['id']);
            foreach ($delete_ids as $id) {
                $wpdb->update($table_name,  ['is_trash' => 1], ['id' => $id]);
            }
            
            wp_redirect(esc_url(remove_query_arg(array('action', 'action2'))));
            exit;
        }
    }

    private function table_data() {
        // Fetch your custom data here (e.g., from a custom database table)
        global $wpdb;
        $where = '';
        if (!empty($_REQUEST['s'])) {
            $search = esc_sql($_REQUEST['s']);
            $where = " and (odname LIKE '%$search%' OR odcity LIKE '%$search%' OR odmobile LIKE '%$search%' OR odemail LIKE '%$search%' OR odamount LIKE '%$search%')";
        }
        $table_name = $wpdb->prefix . 'online_donation_master'; // Replace with your custom table name
        $results = $wpdb->get_results("SELECT * FROM $table_name WHERE is_trash = 0 $where ORDER BY id DESC", ARRAY_A);
        
        return $results;
    }
    // Add the search box
    public function search_box($text, $input_id) {
        if (empty($_REQUEST['s']) && !$this->has_items()) {
            return;
        }

        $input_id = $input_id . '-search-input';
        ?>
        <p class="search-box">
            <label class="screen-reader-text" for="<?php echo esc_attr($input_id); ?>"><?php echo esc_html($text); ?></label>
            <input type="search" id="<?php echo esc_attr($input_id); ?>" name="s" value="<?php echo $_REQUEST['s']; ?>" />
            <?php submit_button($text, '', '', false, array('id' => 'search-submit')); ?>
        </p>
        <?php
    }

    // Display function: Renders the table
    public function display() {
        // Output search box
        $this->search_box('Search', 'custom_search');

        // Output table
        parent::display();
        ?>
        <style>
            .check-column input[type="checkbox"] {

                height: 15px;
                width: 15px;
            }
            .check-column input[type="checkbox"]:focus {
                outline: unset;
            }

            .check-column input[type="checkbox"]:before {
                width: 23px;
                margin: -4px -6px;
            }
        </style>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">View Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Dynamic content will be loaded here -->
                        <div id="modal-content-body">Loading...</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(".view-popup").on("click", function(e) {
                    e.preventDefault(); // Prevent the default link action
                    
                    var id = $(this).data("id"); // Get the ID from the data attribute
                    $("#modal-content-body").html('Loading...');
                    // Perform AJAX request to load the content
                    $.ajax({
                        url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
                        type: "POST",
                        data: {
                            action: "load_online_donation_content", // Custom action hook
                            id: id
                        },
                        success: function(response) {
                            // Load the response into the modal content body
                            $("#modal-content-body").html(response);
                        },
                        error: function() {
                            $("#modal-content-body").html("Error loading data.");
                        }
                    });
                });
            });
        </script>
        <?php
    }
}