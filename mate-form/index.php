<?php
/*  
Plugin Name: mate-form
  
Description: плагин для Wordpress который будет представлять из себя систему запроса обратной связи
 
Version: 1.0
 
Author: Mate
  
Text Domain: mate-form
 
*/
?>
<style>
    .form-group{
        margin-left: auto;
        margin-right: auto;
        width: 15em;
    }
    input{
        width:100%;
        margin: auto !important;;
    }
    .group-items{
        margin-top:11px;
    }
</style>    
<?

function form_conclusion() {
   echo 'Hello';
   ?>
<form class="form-group">
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
   <?
 }
 
 add_shortcode( 'form_conclusion_shortcode', 'form_conclusion');