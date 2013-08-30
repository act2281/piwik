<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 * @category Piwik
 * @package Piwik
 */

namespace Piwik\Translate\Validate;

use Piwik\Translate\Validate\ValidateAbstract;
use Piwik\Common;

/**
 * @package Piwik
 * @subpackage Piwik_Translate
 */
class NoScripts extends ValidateAbstract
{
    /**
     * Validates the given translations
     *
     * @param array $translations
     *
     * @return boolean
     *
     */
    public function isValid($translations)
    {
        $this->_error = null;

        // check if any translation contains restricted script tags
        $serializedStrings = serialize($translations);
        $invalids = array("<script", 'document.', 'javascript:', 'src=', 'background=', 'onload=');
        foreach ($invalids as $invalid) {
            if (stripos($serializedStrings, $invalid) !== false) {
                $this->_error = 'script tags restricted for language files';
                return false;
            }
        }
        return true;
    }
}