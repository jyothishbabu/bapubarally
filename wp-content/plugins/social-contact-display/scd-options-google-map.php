<?php

function scd_options_google_map_page_sections() {
	
	$sections = array();
	$sections['google_map'] 		= __('Google Map Settings', 'scd_textdomain');
	
	return $sections;	
}

function scd_options_google_map_page_fields() {
	// Google Map Setting
	$options[] = array(
		"section" => "google_map",
		"id"      => SCD_SHORTNAME . "_google_map_center",
		"title"   => __( 'Center:', 'scd_textdomain' ),
		"desc"    => __( 'Coordinates sperated by a comma ', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('41.88,-87.63','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "google_map",
		"id"      => SCD_SHORTNAME . "_google_map_zoom",
		"title"   => __( 'Zoom:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "select",
		"std"     => "14",
		"choices" => array( "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20" )
	);
	
	$options[] = array(
		"section" => "google_map",
		"id"      => SCD_SHORTNAME . "_google_map_size",
		"title"   => __( 'Size:', 'scd_textdomain' ),
		"desc"    => __( 'Size in pixels', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('400x400','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "google_map",
		"id"      => SCD_SHORTNAME . "_google_map_scale",
		"title"   => __( 'Scale:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "select",
		"std"     => "1",
		"choices" => array( "1", "2" )
	);
	
	$options[] = array(
		"section" => "google_map",
		"id"      => SCD_SHORTNAME . "_google_map_sensor",
		"title"   => __( 'Sensor:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "select",
		"std"     => "false",
		"choices" => array( "true", "false" )
	);
	
	$options[] = array(
		"section" => "google_map",
		"id"      => SCD_SHORTNAME . "_google_map_maptype",
		"title"   => __( 'Map type:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "select",
		"std"     => "roadmap",
		"choices" => array( "roadmap", "satellite", "terrain", "hybrid" )
	);
	
	$options[] = array(
		"section" => "google_map",
		"id"      => SCD_SHORTNAME . "_google_map_format",
		"title"   => __( 'Format:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "select",
		"std"     => "png",
		"choices" => array( "png", "gif", "jpg" )
	);
	
	return $options;	
}

function scd_options_google_map_page_contextual_help() {
	
	$text 	= "<h3>" . __('Google Map Settings - Contextual Help','scd_textdomain') . "</h3>";
	$text 	.= "<p>" . __('Contextual help goes here. You may want to use different html elements to format your text as you want.','scd_textdomain') . "</p>";
	
	// must return text! NOT echo
	return $text;
} ?>