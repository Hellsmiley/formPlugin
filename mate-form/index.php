<?php
/*  
Plugin Name: mate-form
  
Description: плагин для Wordpress который будет представлять из себя систему запроса обратной связи
 
Version: 1.0
 
Author: Mate
  
Text Domain: mate-form
 
*/
add_action('admin_menu', 'mate_form_plugin_setup_menu');
add_action( 'admin_init', 'load_plugin' );

function mate_form_plugin_setup_menu(){
    add_menu_page( 'Form Page', 'Form Plugin', 'manage_options', 'form_plugin', 'form_init' );
}

function load_plugin() {
        global $wpdb;
        // пример: add_action ('init', 'my_init_function');
        $table_name = $wpdb->prefix . "mate_form";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
           
           $sql = "CREATE TABLE " . $table_name . " (
           id mediumint(9) NOT NULL AUTO_INCREMENT,
           date bigint(11) DEFAULT '0' NOT NULL,
           name tinytext NOT NULL,
           email varchar(255) NOT NULL,
           phone varchar(45) NOT NULL,
           UNIQUE KEY id (id)
         );";
     
         require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
           dbDelta($sql);

        }

}

function form_init(){
    form_data_table();
    
}

function form_data_table(){
    echo 'table';

}

function post_add(){
    global $wpdb;
    $post_data = $_POST['data'];
        $a = explode('&',$post_data);
       foreach($a as $item){
           $b = explode('=',$item);
           $data[$b[0]] = $b[1];
       }
    global $wpdb;

                
    $name = $data['name'];
    $email = $data['email']; 
    $phone = $data['phone'];
    $date = $data['date']; 

    $sql = "INSERT INTO `wp_mate_form`
    (`name`,`email`,`phone`,`date`) 
    values ('$name', '$email', '$phone', '$date')";
    // print_r($sql);
    $result_check = $wpdb->query($sql);
    if($result_check){
        echo 1;
     }else{
       echo 0;
     }
    die();
}

function form_conclusion() {
   echo 'Hello';
   ?>
   <style>
    .form-group{
        margin-left: auto;
        margin-right: auto;
        width: 15em;
    }
    .group-items>input{
        width:100%;
        margin: auto !important;;
    }
    .group-items{
        margin-top:11px;
    }
    /* Popup container - can be anything you want */
.popup {
  position: absolute;
  right: 50%;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* The actual popup */
.popup .popuptext {
  visibility: hidden;
  width: 160px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */


/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
</style>    
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>

<div>
    <form class="form-group"  method="post" id="contactForm">
    <div class="group-items">
        <label for="name">Name:</label>
            <input type="text" id="name" name="name">
        </div>    
        <div class="group-items">    
        <label for="email">Email:</label>
            <input type="text" id="email" name="email">
        </div>    
        <div class="group-items">    
        <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone">
        </div>    
        <div class="group-items">        
        <label for="date">Date:</label>
            <input type="text" id="date" name="date">
        </div>    
        <div class="group-items">    
            <input type="submit" value="Submit">
        </div>
    </form>
    <div class="popup" >
        <span class="popuptext" id="myPopup">Данні успішно відправлені!</span>
    </div>
</div>
<script type="text/javascript">
    var frm = $('#contactForm');

    frm.submit(function (e) {

        e.preventDefault();
        var formData = frm.serialize();
        $.ajax({
            type: frm.attr('method'),
            data: { 
                action: 'mform',
                data: formData,  
            },
            url: '/wp-admin/admin-ajax.php',
            success: function (data) {
                if (data == "1") {
                    var popup = document.getElementById("myPopup");
                    popup.classList.add("show");
                    // popup.classList.toggle("show");
                    // $("#myPopup").fadeOut( "slow");
                    setTimeout(popupHide, 3000);
                    function popupHide() {
                        popup.classList.remove("show");
                    }
                } else {
                    $('[id$=' + txtRate + ']').focus();
                }
            }
        });
    });
</script>
   <?
 }
 add_action('wp_ajax_nopriv_mform','post_add');
add_action('wp_ajax_mform','post_add');

 add_shortcode( 'form_conclusion_shortcode', 'form_conclusion');