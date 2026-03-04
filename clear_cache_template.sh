#!/bin/bash
# Clear Vtiger cache and Smarty compiled templates

echo "Clearing Vtiger cache..."

# Clear Smarty compiled templates (IMPORTANT: must clear after UI changes)
rm -rf test/templates_c/v7/*.php
rm -rf test/templates_c/vlayout/*.php
rm -rf test/templates_c/*.php
echo "  - Smarty compiled templates cleared"

# Clear cache directory
rm -rf test/cache/*
rm -rf cache/vte/*
rm -rf cache/vtlib/*
echo "  - Cache directories cleared"

# Clear user privileges cache
# rm -rf user_privileges/user_privileges_*
# rm -rf user_privileges/sharing_privileges_*

echo ""
echo "Cache cleared successfully!"
echo "Please refresh your browser (Ctrl+F5) and try again."
