<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation\Rule;

/**
 * Defines tests for Value
 *
 * @package Fuel\Validation\Rule
 * @author  Fuel Development Team
 *
 * @coversDefaultClass  \Fuel\Validation\Rule\Value
 */
class ValueTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field is not one of the given value(s).';

	protected function _before()
	{
		$this->object = new Value;
	}

	/**
	 * Provides sample data for testing the email validation
	 *
	 * @return array
	 */
	public function validateProvider()
	{
		return array(
			array('admin@test.com', true, 'admin@test.com'),
			array('admin@test.com', false, 'admin'),
			array('admin@test.com', true, array('admin', 'admin@test.com')),
			array(1, true, '1'),
			array(1, false, array('strict' => true, 'values' => array('1'))),
			array(1, false, array('strict' => true, 'values' => array(1.00))),
			array(1, true, array('strict' => true, 'values' => array(1))),
			array(null, false, null),
		);
	}

	/**
	 * @covers ::isStrict
	 * @covers ::setParameter
	 * @covers ::setStrict
	 * @group  Validation
	 */
	public function testStrict()
	{
		$this->assertFalse($this->object->isStrict());

		$this->object->setParameter(array('strict' => true, 'values' => array()));

		$this->assertTrue($this->object->isStrict());

		$this->assertEquals(
			$this->object,
			$this->object->setStrict(false)
		);

		$this->assertFalse($this->object->isStrict());
	}

	/**
	 * @covers ::setParameter
	 * @group  Validation
	 */
	public function testSetParameter()
	{
		$this->object->setParameter('test value');
		$this->assertEquals(array('test value'), $this->object->getParameter());

		$this->object->setParameter(array('strict' => true, 'values' => array('another value')));
		$this->assertEquals(array('another value'), $this->object->getParameter());

		$this->object->setParameter(array('value1', 'value2'));
		$this->assertEquals(array('value1', 'value2'), $this->object->getParameter());
	}

}
