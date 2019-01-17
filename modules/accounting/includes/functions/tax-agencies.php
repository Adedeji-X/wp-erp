<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Get all taxes
 *
 * @return mixed
 */

function erp_acct_get_all_tax_agencies( $args = [] ) {
        global $wpdb;
    
        $defaults = [
            'number'     => 20,
            'offset'     => 0,
            'orderby'    => 'id',
            'order'      => 'DESC',
            'count'      => false,
            's'          => '',
        ];
    
        $args = wp_parse_args( $args, $defaults );
    
        $limit = '';
    
        if ( $args['number'] != '-1' ) {
            $limit = "LIMIT {$args['number']} OFFSET {$args['offset']}";
        }
    
        $sql = "SELECT";
        $sql .= $args['count'] ? " COUNT( id ) as total_number " : " * ";
        $sql .= "FROM {$wpdb->prefix}erp_acct_tax_agencies ORDER BY {$args['orderby']} {$args['order']} {$limit}";
    
        if ( $args['count'] ) {
            return $wpdb->get_var($sql);
        }
    
        return $wpdb->get_results( $sql, ARRAY_A );
}

/**
 * Get an single tax
 *
 * @param $tax_no
 *
 * @return mixed
 */

function erp_acct_get_tax_agency( $tax_no ) {
    global $wpdb;

    $sql = "SELECT * FROM {$wpdb->prefix}erp_acct_tax_agencies
    WHERE tax.id = {$tax_no} LIMIT 1";

    $row = $wpdb->get_row( $sql, ARRAY_A );

    return $row;
}

/**
 * Insert tax data
 *
 * @param $data
 * @return int
 */
function erp_acct_insert_tax_agency( $data ) {
    global $wpdb;

    $created_by = get_current_user_id();
    $data['created_at'] = date("Y-m-d H:i:s");
    $data['created_by'] = $created_by;

    $tax_data = erp_acct_get_formatted_tax_data( $data );

    $wpdb->insert($wpdb->prefix . 'erp_acct_tax_agencies', array(
        'name'       => $tax_data['name'],
        'created_at' => $tax_data['created_at'],
        'created_by' => $tax_data['created_by'],
        'updated_at' => $tax_data['updated_at'],
        'updated_by' => $tax_data['updated_by'],
    ));

    $tax_id = $wpdb->insert_id;

    return $tax_id;

}

/**
 * Update tax data
 *
 * @param $data
 * @return int
 */
function erp_acct_update_tax_agency( $data, $id ) {
    global $wpdb;

    $updated_by = get_current_user_id();
    $data['updated_at'] = date("Y-m-d H:i:s");
    $data['updated_by'] = $updated_by;

    $tax_data = erp_acct_get_formatted_tax_data( $data );

    $wpdb->update($wpdb->prefix . 'erp_acct_tax_agencies', array(
        'name'       => $tax_data['name'],
        'description'=> $tax_data['description'],
        'created_at' => $tax_data['created_at'],
        'created_by' => $tax_data['created_by'],
        'updated_at' => $tax_data['updated_at'],
        'updated_by' => $tax_data['updated_by'],
    ), array(
        'id' => $id
    ));

    return $id;

}

/**
 * Delete an tax
 *
 * @param $tax_no
 *
 * @return int
 */

function erp_acct_delete_tax_agency( $id ) {
    global $wpdb;

    $wpdb->delete( $wpdb->prefix . 'erp_acct_tax_agencies', array( 'id' => $id ) );

    return $id;
}

