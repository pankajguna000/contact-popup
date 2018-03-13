<?php

class Fgcf {
    public static $table_name;
    /**
     * Stores the plugin version.
     *
     * @var string
     * @access private
     */
    public function __construct() {
        global $wpdb;
        Fgcf::$table_name = $wpdb->prefix . "fgcf_form_table";
    }
    static function fgcf_show_form() {
	?>
<form action="#" method="post">
<div class="contact_button">
<img src=<?php echo plugins_url("image/contact-button.png", __FILE__); ?> >
</div>
<div class="contact_top_div">
<div id="cont_us">
<div id="cont_text">
<div id="cont_head">Contact us</div>
<div class="cont_close"><img id="anc_close" src=<?php echo plugins_url('image/close.png', __FILE__); ?>></div>
</div>
<div id="cont_color">

</div>
</div>
<div id="contact_form_div">
<div id='text_sub' style="display:none;">Thank You for Submission</div>
<div id="data_of_contact">
<table id="contact_table">
<tr id="cont_tr">
<td id="cont_td">
<input id="cont_name" type="text" name="name" value="" placeholder="Name">
</td>
</tr>
<tr id="cont_tr">
<td id="cont_td">
<input id="cont_email_id" type="text" name="email" value="" placeholder="Email">
</td></tr>
<tr id="cont_tr">
<td id="cont_td">
<textarea id="cont_textarea" name="msg" placeholder="Message"></textarea>
</td>
</tr>
<tr id="cont_tr">
<td id="cont_td">
<input id="cont_submit" type="button" name="cont_submit_name" value="Submit"> 
</td>
</tr>
</table>
</div>
</div>
</div>

</form>
	<?php }
    /**
     * Stores the plugin version.
     *
     * @var string
     * @access private
     */
    function fgcf_insert_data($name, $email, $msg) {
	    global $wpdb;
          $data = array(
                'user_name' => $name,
                'user_email' => $email,
                'user_message' => $msg
            );
            $wpdb->insert(Fgcf::$table_name, $data);
        return true;
    }
    /**
     * Create table in database
     *
     * @var string
     * @access private
     */
    function fgcf_table_install() {
        global $wpdb;
        $sql = "CREATE TABLE " . Fgcf::$table_name . " (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  user_name VARCHAR(255) NOT NULL,
	  user_email VARCHAR(255) NOT NULL,
	  user_message TEXT NOT NULL,
	  UNIQUE KEY id (id)
	);";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    /**
     * Show data from table
     *
     * @var string
     * @access private
     */
    function fgcf_show_data() {
        $path = plugins_url('/image/edit_icon.png', __FILE__);
        $img_path = plugins_url('/image/delete_icon.jpg', __FILE__);
        if (isset($_GET["page_count"])) {
            $page = $_GET["page_count"];
        } else {
            $page = 1;
        }
        $start_from = ($page - 1) * 20;
        global $wpdb;
        $query = $wpdb->get_results("SELECT * FROM " . Fgcf::$table_name . " LIMIT $start_from, 20");
        ?>
        <table class="widefat">
            <thead>
                <tr class="display_header">
                    <th width="150px">Name</th>
                    <th width="200px">Email</th>
                    <th width="350px">Message</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
        <?php
        foreach ($query as $key) {
            ?>
                <tr class="fgcf_entries">
                    <td class="fgcf_name"><?php echo $key->user_name; ?></td> &nbsp;
                    <td class="fgcf_email"><?php echo $key->user_email; ?></td> &nbsp;
                    <td class="fgcf_message"><?php echo $key->user_message; ?></td> &nbsp;
                    <td class="fgcf_action_icon"><div class="update_entry"><a class="edit_entry" id="edit_entry" href="javascript:void(0);" entry_id="<?php echo $key->id; ?>"><img src=<?php echo $path; ?> alt="edit_icon" ></a></div></td>&nbsp; 
                    <td><div class="delete_entry" entry_id="<?php echo $key->id; ?>"><img src=<?php echo $img_path; ?> alt="delete_icon" ></div></td> &nbsp;
                </tr>
                <?php
            }
            echo "</table>";
            $sql = $wpdb->get_results("SELECT  COUNT(id) as c FROM " . Fgcf::$table_name);
            foreach ($sql as $row) {
                $total_records = $row->c;
            }
            $total_pages = ceil($total_records / 20);
			echo "</br>";
			if($total_pages>1){
            for ($i = 1; $i <= $total_pages; $i++) {
				
                echo "<a href='admin.php?page=Fgcf_page&page_count=" . $i . "'>" . $i . "</a> ";
            }}
        }
        /**
         * Delete data from table
         *
         * @var string
         * @access private
         */
        function fgcf_delete_data($id) {
            global $wpdb;
            $query = $wpdb->get_results("delete from " . Fgcf::$table_name . " where id= $id");
            return true;
        }
        function fgcf_update_data($id) {
            global $wpdb;
            if (isset($_POST['update'])) {
                $name = sanitize_text_field($_POST['fgcf-form_name']);
                $email = sanitize_email($_POST['fgcf-form_email']);
                $message = sanitize_text_field($_POST['fgcf-form_message']);
                $wpdb->update(
                        Fgcf::$table_name, array(
                    'user_name' => $name,
                    'user_email' => $email,
                    'user_message' => $message
                        ), array('ID' => $id), array(
                    '%s',
                    '%s',
                    '%s'
                        ), array('%d')
                );
            }
            return true;
        }
		
       function embeded_code() {
            global $wpdb;
            $result = get_option('fg_embed_code');
            echo stripslashes($result);
        }
        function fgcf_update_form_entry() {
			?>
            <div class="fgcf_dialog_form" id="fgcf_dialog_form">
                <form method="post">
                    <div class="form_id" id="form_id">
                        <input type="hidden" name="fgcf_form_id" id="fgcf_form_id" value="" /> 
                    </div>
                    <div id="fgcf-name_wraper" class="fgcf-name_wraper">
                        <p class="fgcf-form_name" id="fgcf-form_name">
                        <div class="fgcf-form_label"> <label for="form_name"> Name:</label></div>
                        <input type="text" name="fgcf-form_name" id="fgcf-form_name" value="" />
                        </p>
                    </div>
                    <div id="email_wraper" class="email_wraper">
                        <p class="fgcf-form_email" id="fgcf-form_email">
                        <div class="fgcf-form_label"> <label for="fgcf-form_email"> Email:</label> </div>
                        <input type="text" name="fgcf-form_email" id="fgcf-form_email" value="" />
                        </p>
                    </div>
                     <div id="message_wraper" class="message_wraper">
                        <p class="fgcf-form_message" id="fgcf-form_message">
                        <div class="fgcf-form_label"> <label for="fgcf-form_message"> Message:</label> </div>
                        <textarea name="fgcf-form_message" id="fgcf-form_message" cols="45" rows="5" value=""></textarea>
                        </p>
                    </div>
                    <div class="submit_div">
                        <p id="submit_wrapper">
                            <input type="submit" name="update" class="form_update_entry" value="Update" />
                        </p>					
                        <p class="clear_both"></p>		
                    </div>
                </form>
            </div>
        <?php
    }
}
$obj = new Fgcf();
?>