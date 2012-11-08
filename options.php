<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	$themename = 'wildcommunity';
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Test data
	$test_array = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
	
	// Multicheck Array
	$multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
	
	// Multicheck Defaults
	$multicheck_defaults = array("one" => "1","five" => "1");
	
	// Background Defaults
	
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/images/';
		
	$options = array();


	$options[] = array( "name" => "General Settings",
						"type" => "heading");
							
	$options[] = array( "name" => "Uploader",
						"desc" => "You can upload your logo or something else and paste path below.",
						"id" => "example_uploader",
						"type" => "upload");


	$options[] = array( "name" => "Your logo`s path",
						"desc" => "Put your logo`s path here. You can upload your logo using Uploader",
						"id" => "logo_path",
						"std" => "http://www.demo1.diaboliquedesign.com/3/logo.png",
						"type" => "text");


	$options[] = array( "name" => "Background color of `Create an account` link",
						"desc" => "",
						"id" => "color1",
						"std" => "#d80203",
						"type" => "color");

	$options[] = array( "name" => "Background color of buttons",
						"desc" => "",
						"id" => "color2",
						"std" => "#f2763b",
						"type" => "color");


	$options[] = array( "name" => "Website Analytics",
						"desc" => "You can paste analytics code here",
						"id" => "analytics",
						"std" => "",
						"type" => "textarea");







	$options[] = array( "name" => "Frontpage",
						"type" => "heading");


$options[] = array( "name" => "Welcome message",
						"desc" => "Welcome mesage on the frontpage",
						"id" => "welcome",
						"std" => "Welcome to WildCommunity",
						"type" => "text");



	$options[] = array( "name" => "Number of members",
						"desc" => "Information visible on the frontpage about number of members",
						"id" => "members",
						"std" => "75.000 members and counting...",
						"type" => "text");



	$options[] = array( "name" => "Info about your website",
						"desc" => "Information visible below header about your website",
						"id" => "info",
						"std" => "BuddyPress lets users register on your site and start creating profiles, posting messages, making connections, creating and interacting in groups and much more. A social network in a box, BuddyPress lets you build a social network for your company, school, sports team or niche community.",
						"type" => "textarea");


	$options[] = array( "name" => "1st Box",
						"desc" => "1st box title",
						"id" => "1box-title",
						"std" => "Our Forums",
						"type" => "text");

	$options[] = array( "name" => "1st Box Decription",
						"desc" => "1st box description",
						"id" => "1box-desc",
						"std" => "Cras fermentum neque et dui adipiscing mattis. Donec vitae justo lacus, vitae rutrum dolor. Donec dolor leo, blandit sit amet mattis id, ultricies sed risus.",
						"type" => "textarea");


	$options[] = array( "name" => "1st Box Link",
						"desc" => "1st box link",
						"id" => "1box-link",
						"std" => "forums",
						"type" => "text");


	$options[] = array( "name" => "2nd Box",
						"desc" => "2nd box title",
						"id" => "2box-title",
						"std" => "Our Groups",
						"type" => "text");


	$options[] = array( "name" => "2nd Box Decription",
						"desc" => "2nd box description",
						"id" => "2box-desc",
						"std" => "Morbi ipsum mauris, volutpat dictum pharetra a, congue sit amet neque. Fusce a nisl id est auctor tincidunt. Etiam laoreet orci, nec consequat.",
						"type" => "textarea");


	$options[] = array( "name" => "2nd Box Link",
						"desc" => "2nd box link",
						"id" => "2box-link",
						"std" => "groups",
						"type" => "text");


	$options[] = array( "name" => "3rd Box",
						"desc" => "3rd box title",
						"id" => "3box-title",
						"std" => "How it works?",
						"type" => "text");


	$options[] = array( "name" => "3rd Box Decription",
						"desc" => "3rd box description",
						"id" => "3box-desc",
						"std" => "In hac habitasse platea dictumst. Morbi ipsum mauris, volutpat dictum pharetra a, congue sit amet neque. Fusce a nisl id est volutpat dictum.",
						"type" => "textarea");


	$options[] = array( "name" => "3rd Box Link",
						"desc" => "3rd box link",
						"id" => "3box-link",
						"std" => "about-us",
						"type" => "text");

	$options[] = array( "name" => "4rd Box",
						"desc" => "4rd box title",
						"id" => "4box-title",
						"std" => "Our Members",
						"type" => "text");


	$options[] = array( "name" => "4rd Box Link",
						"desc" => "4rd box link",
						"id" => "4box-link",
						"std" => "members",
						"type" => "text");









	$options[] = array( "name" => "Translations",
						"type" => "heading");
							

	$options[] = array( "name" => "Recent replies",
						"desc" => "`Recent replies` translation",
						"id" => "t-3",
						"std" => "Recent replies",
						"type" => "text");


	$options[] = array( "name" => "All rights reserved by",
						"desc" => "`All rights reserved by` translation",
						"id" => "t-4",
						"std" => "All rights reserved by",
						"type" => "text");


	$options[] = array( "name" => "Home",
						"desc" => "`Home` translation",
						"id" => "t-5",
						"std" => "Home",
						"type" => "text");

	$options[] = array( "name" => "or",
						"desc" => "`or` translation",
						"id" => "t-6",
						"std" => "or",
						"type" => "text");


	$options[] = array( "name" => "Hello",
						"desc" => "`Hello` translation",
						"id" => "t-7",
						"std" => "Hello",
						"type" => "text");


	$options[] = array( "name" => "Search",
						"desc" => "`Search` translation",
						"id" => "t-8",
						"std" => "Search",
						"type" => "text");


	$options[] = array( "name" => "Popular",
						"desc" => "`Popular` translation",
						"id" => "t-9",
						"std" => "Popular",
						"type" => "text");

	$options[] = array( "name" => "Active",
						"desc" => "`Active` translation",
						"id" => "t-10",
						"std" => "Active",
						"type" => "text");


	$options[] = array( "name" => "Alphabetical",
						"desc" => "`Alphabetical` translation",
						"id" => "t-11",
						"std" => "Alphabetical",
						"type" => "text");


	$options[] = array( "name" => "Newest",
						"desc" => "`Newest` translation",
						"id" => "t-12",
						"std" => "Newest",
						"type" => "text");


	$options[] = array( "name" => "Groups",
						"desc" => "`Groups` translation",
						"id" => "t-13",
						"std" => "Groups",
						"type" => "text");


	$options[] = array( "name" => "`Groups` link",
						"desc" => "`Groups link` translation",
						"id" => "t-14",
						"std" => "groups",
						"type" => "text");

	$options[] = array( "name" => "Blog categories",
						"desc" => "Blog categories translation",
						"id" => "t-15",
						"std" => "Blog categories",
						"type" => "text");


	$options[] = array( "name" => "Community News",
						"desc" => "Community News translation",
						"id" => "t-16",
						"std" => "Community News",
						"type" => "text");

	$options[] = array( "name" => "`Blog` link",
						"desc" => "`blog` link translation",
						"id" => "t-17",
						"std" => "blog",
						"type" => "text");

	$options[] = array( "name" => "`Login to your account and check new messages` translation",
						"desc" => "`Login to your account and check new messages.` translation",
						"id" => "t-18",
						"std" => "Login to your account and check new messages.",
						"type" => "text");


	$options[] = array( "name" => "`Tags` translation",
						"desc" => "`Tags` translation",
						"id" => "t-19",
						"std" => "Tags",
						"type" => "text");


	$options[] = array( "name" => "`Related Posts` translation",
						"desc" => "`Related Posts` translation",
						"id" => "t-20",
						"std" => "Related Posts",
						"type" => "text");


		
	return $options;
}