<?php
/**
 * PDFMaker2 — Module Handler
 * This is a non-entity module (settings only), so vtlib_handler is minimal.
 */
class PDFMaker2 {

    /**
     * Invoked when special actions are performed on the module.
     * @param String Module name
     * @param String Event Type (module.postinstall, module.disabled, module.enabled, module.preuninstall)
     */
    function vtlib_handler($modulename, $event_type) {
        if ($event_type == 'module.postinstall') {
            // Module has been installed
        } else if ($event_type == 'module.disabled') {
            // Module has been disabled
        } else if ($event_type == 'module.enabled') {
            // Module has been enabled
        } else if ($event_type == 'module.preuninstall') {
            // Module is about to be uninstalled
        } else if ($event_type == 'module.preupdate') {
            // Module is about to be updated
        } else if ($event_type == 'module.postupdate') {
            // Module has been updated
        }
    }
}
