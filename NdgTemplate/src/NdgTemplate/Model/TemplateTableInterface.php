<?php
/**
 * Farther Horizon Site Kit
 *
 * @link       http://github.com/alanwagner/FHSK for the canonical source repository
 * @copyright Copyright (c) 2013 Farther Horizon SARL (http://www.fartherhorizon.com)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPLv3 License
 * @author    Alan Wagner (mail@alanwagner.org)
 */

namespace NdgTemplate\Model;

use Zend\Db\TableGateway\TableGateway;

/**
 * Template table interface
 */
interface TemplateTableInterface
{
    /**
     * Fetch all templates
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll();

    /**
     * Fetch only active or archived templates
     * @param int $isArchived  0 or 1
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchByIsArchived($isArchived);

    /**
     * Get a single template by id
     * @param int $id
     * @throws \Exception
     * @return Template
     */
    public function getTemplate($id);

    /**
     * Prepare and save template data
     *
     * Could be creating a new template or updating an existing one
     *
     * @param Template $template
     * @throws \Exception
     */
    public function saveTemplate(Template $template);

    /**
     * Delete a template
     * @param int $id
     */
    public function deleteTemplate($id);
}
