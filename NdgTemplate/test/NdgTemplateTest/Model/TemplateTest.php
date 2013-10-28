<?php
/**
 * Farther Horizon Site Kit
 *
 * @link       http://github.com/alanwagner/FhSiteKit for the canonical source repository
 * @copyright Copyright (c) 2013 Farther Horizon SARL (http://www.fartherhorizon.com)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPLv3 License
 * @author    Alan Wagner (mail@alanwagner.org)
 */

namespace NdgTemplateTest\Model;

use Ndg\NdgTemplate\Model\Template;
use PHPUnit_Framework_TestCase;

/**
 * Tests on the Template entity
 */
class TemplateTest extends PHPUnit_Framework_TestCase
{
    public function testTemplateInitialState()
    {
        $template = new Template();

        $this->assertNull($template->id);
        $this->assertNull($template->pattern_id);
        $this->assertNull($template->name);
        $this->assertNull($template->description);
        $this->assertNull($template->instance_name);
        $this->assertNull($template->serial);
        $this->assertNull($template->is_archived);
        $this->assertNull($template->created_at);
        $this->assertNull($template->updated_at);
    }

    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $template = $this->getTemplateWithData();
        $data  = $this->getTemplateDataArray();

        $this->assertSame($data['id'], $template->id);
        $this->assertSame($data['pattern_id'], $template->pattern_id);
        $this->assertSame($data['name'], $template->name);
        $this->assertSame($data['description'], $template->description);
        $this->assertSame($data['instance_name'], $template->instance_name);
        $this->assertSame($data['serial'], $template->serial);
        $this->assertSame($data['is_archived'], $template->is_archived);
        $this->assertSame($data['created_at'], $template->created_at);
        $this->assertSame($data['updated_at'], $template->updated_at);
    }

    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $template = $this->getTemplateWithData();
        $template->exchangeArray(array());

        $this->assertNull($template->id);
        $this->assertNull($template->pattern_id);
        $this->assertNull($template->name);
        $this->assertNull($template->description);
        $this->assertNull($template->instance_name);
        $this->assertNull($template->serial);
        $this->assertNull($template->is_archived);
        $this->assertNull($template->created_at);
        $this->assertNull($template->updated_at);
    }

    public function testGetArrayCopyReturnsAnArrayWithPropertyValues()
    {
        $template = $this->getTemplateWithData();
        $data  = $this->getTemplateDataArray();
        $copyArray = $template->getArrayCopy();

        $this->assertSame($data['id'], $copyArray['id']);
        $this->assertSame($data['pattern_id'], $copyArray['pattern_id']);
        $this->assertSame($data['name'], $copyArray['name']);
        $this->assertSame($data['description'], $copyArray['description']);
        $this->assertSame($data['instance_name'], $copyArray['instance_name']);
        $this->assertSame($data['serial'], $copyArray['serial']);
        $this->assertSame($data['is_archived'], $copyArray['is_archived']);
        $this->assertSame($data['created_at'], $copyArray['created_at']);
        $this->assertSame($data['updated_at'], $copyArray['updated_at']);
    }

    public function testInputFiltersAreSetCorrectly()
    {
        $template = new Template();

        $inputFilter = $template->getInputFilter();

        $this->assertSame(5, $inputFilter->count());
        $this->assertTrue($inputFilter->has('id'));
        $this->assertTrue($inputFilter->has('pattern_id'));
        $this->assertTrue($inputFilter->has('name'));
        $this->assertTrue($inputFilter->has('description'));
        $this->assertTrue($inputFilter->has('instance_name'));
    }

    /**
     * Get Template entity initialized with standard data
     * @return Ndg\NdgTemplate\Model\Template
     */
    protected function getTemplateWithData()
    {
        $template = new Template();
        $data  = $this->getTemplateDataArray();
        $template->exchangeArray($data);

        return $template;
    }

    /**
     * Get standard template data as array
     * @return array
     */
    protected function getTemplateDataArray()
    {
        return array(
            'id'            => 420,
            'pattern_id'    => 429,
            'name'          => 'template name',
            'description'   => 'N=3, Z=2',
            'instance_name' => '4.## Cond 1 #pattern',
            'serial'        => 19,
            'is_archived'   => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        );
    }
}
