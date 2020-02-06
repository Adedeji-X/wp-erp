<?php
namespace WeDevs\ERP\HRM\Models;

use WeDevs\ERP\Framework\Model;

/**
 * Class Leave
 *
 * @package WeDevs\ERP\HRM\Models
 */
class Leave extends Model {
    protected $table = 'erp_hr_leaves_new';

    protected $fillable = [ 'name', 'description' ];

    /**
     * Relation to Leave_Policies model
     *
     * @since 1.6.0
     *
     * @return object
     */
    public function policies() {
        return $this->hasMany( 'WeDevs\ERP\HRM\Models\Leave_Policy' );
    }

    /**
     * Relation to Leave_Entitlement model
     *
     * @since 1.6.0
     *
     * @return object
     */
    public function entitlements() {
        return $this->hasMany( 'WeDevs\ERP\HRM\Models\Leave_Entitlement' );
    }

    /**
     * Relation to Leave_Request model
     *
     * @since 1.6.0
     *
     * @return object
     */
    public function requests() {
        return $this->hasMany( 'WeDevs\ERP\HRM\Models\Leave_Request' );
    }

    /**
     * Relation to Leaves_Unpaid model
     *
     * @since 1.6.0
     *
     * @return object
     */
    public function unpaids() {
        return $this->hasMany( 'WeDevs\ERP\HRM\Models\Leaves_Unpaid' );
    }
}