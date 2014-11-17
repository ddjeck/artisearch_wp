<?php
/**
 * @package arti_search
 * @version 1.0
 */
/*
Plugin Name: Search plugin for ARTI company
Description: Плагин подбора товаров
Author: Евгений
Version: 1.0
*/

require("includies/main.php");
require("includies/ajax.php");

add_action( 'wp_enqueue_scripts', 'linkScript' );
add_action( 'wp_enqueue_scripts', 'linkStyle' );
add_action( 'init', 'register_arti_search' );
add_filter( 'the_content', 'setRender' );

if( is_admin() ) 
{
	add_action( 'wp_ajax_arti_search', 'arti_search_callback' );
	add_action( 'wp_ajax_nopriv_arti_search', 'arti_search_callback' );
}

//Подключаем отдельно Js скрипт для ajax и локализируем переменную ajax_url, для возможности использования  аякса во фронтэнде
function linkScript() {
	wp_enqueue_script( 'arti_js', plugins_url( '/assets/js/arti_search.js', __FILE__ ), array('jquery'));
	wp_localize_script( 'arti_js', 'ajax_obj',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

function linkStyle() {
  wp_enqueue_style('arti_css', plugins_url('assets/css/arti_search.css', __FILE__));
}

function register_arti_search() {
	register_sidebar_widget('Поиск товара', 'arti_search'); 
}