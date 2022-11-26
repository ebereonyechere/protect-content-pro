<?php
/**
 * @package     Freemius for EDD Add-On
 * @copyright   Copyright (c) 2015, Freemius, Inc.
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class FS_Pricing extends FS_Entity {

	#region Properties

	/**
	 * @var number
	 */
	public $plan_id;
	/**
	 * @var int
	 */
	public $licenses;
	/**
	 * @var null|float
	 */
	public $monthly_price;
	/**
	 * @var null|float
	 */
	public $annual_price;
	/**
	 * @var null|float
	 */
	public $lifetime_price;
	/**
	 * @author Leo Fajardo (@leorw)
	 * @since 2.3.1
	 *
	 * @var string One of the following: `usd`, `gbp`, `eur`.
	 */
	public $currency;

	#endregion Properties

	/**
	 * @param object|bool $pricing
	 */
	function __construct( $pricing = false ) {
		parent::__construct( $pricing );
	}

	static function get_type() {
		return 'pricing';
	}

	/**
	 * @return bool
	 * @since  1.1.8
	 *
	 * @author Vova Feldman (@svovaf)
	 */
	function has_monthly() {
		return ( is_numeric( $this->monthly_price ) && $this->monthly_price > 0 );
	}

	/**
	 * @return bool
	 * @since  1.1.8
	 *
	 * @author Vova Feldman (@svovaf)
	 */
	function has_annual() {
		return ( is_numeric( $this->annual_price ) && $this->annual_price > 0 );
	}

	/**
	 * @return bool
	 * @since  1.1.8
	 *
	 * @author Vova Feldman (@svovaf)
	 */
	function has_lifetime() {
		return ( is_numeric( $this->lifetime_price ) && $this->lifetime_price > 0 );
	}

	/**
	 * Check if unlimited licenses pricing.
	 *
	 * @return bool
	 * @since  1.1.8
	 *
	 * @author Vova Feldman (@svovaf)
	 */
	function is_unlimited() {
		return is_null( $this->licenses );
	}


	/**
	 * Check if pricing has more than one billing cycle.
	 *
	 * @return bool
	 * @since  1.1.8
	 *
	 * @author Vova Feldman (@svovaf)
	 */
	function is_multi_cycle() {
		$cycles = 0;
		if ( $this->has_monthly() ) {
			$cycles ++;
		}
		if ( $this->has_annual() ) {
			$cycles ++;
		}
		if ( $this->has_lifetime() ) {
			$cycles ++;
		}

		return $cycles > 1;
	}

	/**
	 * Get annual over monthly discount.
	 *
	 * @return int
	 * @since  1.1.8
	 *
	 * @author Vova Feldman (@svovaf)
	 */
	function annual_discount_percentage() {
		return floor( $this->annual_savings() / ( $this->monthly_price * 12 * ( $this->is_unlimited() ? 1 : $this->licenses ) ) * 100 );
	}

	/**
	 * Get annual over monthly savings.
	 *
	 * @return float
	 * @since  1.1.8
	 *
	 * @author Vova Feldman (@svovaf)
	 */
	function annual_savings() {
		return ( $this->monthly_price * 12 - $this->annual_price ) * ( $this->is_unlimited() ? 1 : $this->licenses );
	}

	/**
	 * @return bool
	 * @since  2.3.1
	 *
	 * @author Leo Fajardo (@leorw)
	 */
	function is_usd() {
		return ( 'usd' === $this->currency );
	}
}