<?php
/**
 * AllBehaviorsTest file
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Test.Case
 * @since         CakePHP(tm) v 2.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
namespace Cake\Test\TestCase;
use Cake\TestSuite\TestSuite;

/**
 * AllBehaviorsTest class
 *
 * This test group will run all test in the Case/Model/Behavior directory
 *
 * @package       Cake.Test.Case
 */
class AllBehaviorsTest extends \PHPUnit_Framework_TestSuite {

/**
 * Suite define the tests for this suite
 *
 * @return void
 */
	public static function suite() {
		$suite = new TestSuite('Model Behavior and all behaviors');

		$path = CORE_TEST_CASES . DS . 'Model' . DS . 'Behavior' . DS;
		$suite->addTestFile(CORE_TEST_CASES . DS . 'Model' . DS . 'BehaviorCollectionTest.php');

		$suite->addTestDirectory($path);
		return $suite;
	}
}
