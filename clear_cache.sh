#!/bin/bash
# Clear Vtiger cache

echo "Clearing Vtiger cache..."

# Clear cache directory
rm -rf test/cache/*
rm -rf cache/vte/*
rm -rf cache/vtlib/*

# Clear user privileges cache
rm -rf user_privileges/user_privileges_*
rm -rf user_privileges/sharing_privileges_*

echo "Cache cleared successfully!"
echo "Please refresh your browser and try again."
