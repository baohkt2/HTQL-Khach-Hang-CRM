/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

console.log("✓✓✓ Accounts/List.js is LOADED ✓✓✓");

Vtiger_List_Js(
  "Accounts_List_Js",
  {},
  {
    /**
     * Function to append contacts count to account names in list view
     */
    appendContactsCount: function () {
      console.log("appendContactsCount() called");

      // Check if accountsContactsCount variable exists
      if (typeof accountsContactsCount === "undefined") {
        console.log("accountsContactsCount is undefined");
        return;
      }

      console.log("accountsContactsCount:", accountsContactsCount);

      var thisInstance = this;
      var listViewTable = jQuery("#listview-table");

      console.log("Table found:", listViewTable.length > 0);

      var allRows = listViewTable.find("tr.listViewEntries");

      console.log("Rows found:", allRows.length);

      // Find all account name links in the list view
      allRows.each(function (index) {
        var row = jQuery(this);
        var recordId = row.data("id");

        console.log("--- Processing row " + index + ", recordId:", recordId);

        // Get the count for this account
        var contactsCount = accountsContactsCount[recordId];

        console.log("Count for record " + recordId + ":", contactsCount);

        if (typeof contactsCount !== "undefined") {
          // Find the account name cell - look for link with name field
          // Try to find the link in the column with field name 'accountname'
          var accountNameCell = row
            .find('td[data-field-type="string"] a[href*="view=Detail"]')
            .first();

          // If not found, try alternative selector
          if (accountNameCell.length === 0) {
            accountNameCell = row
              .find("td a.textOverflowEllipsis")
              .not('[title="Details"]')
              .first();
          }

          console.log("Account name cell found:", accountNameCell.length);

          if (accountNameCell.length > 0) {
            var accountName = accountNameCell.text().trim();
            console.log("Current account name:", accountName);
            console.log("Link href:", accountNameCell.attr("href"));
            console.log("Link title:", accountNameCell.attr("title"));

            // Check if count already appended to avoid duplication
            if (accountName.indexOf("[") === -1) {
              // Change the text to include count in brackets
              var newText = accountName + " [" + contactsCount + "]";

              // Method 1: Try replacing text node
              var textNode = accountNameCell
                .contents()
                .filter(function () {
                  return this.nodeType === 3; // Text node
                })
                .first();

              if (textNode.length > 0) {
                textNode[0].nodeValue = newText;
                console.log("✓ Updated text node to:", newText);
              } else {
                // Method 2: If no text node, try setting text directly
                accountNameCell.text(newText);
                console.log("✓ Set text directly to:", newText);
              }
            } else {
              console.log("Already has parentheses, skipping");
            }
          } else {
            console.log("ERROR: Could not find account name cell");
            console.log("Row HTML:", row.html().substring(0, 200));
          }
        } else {
          console.log("No count data for record:", recordId);
        }
      });
    },

    /**
     * Override registerEvents to add our custom logic
     */
    registerEvents: function () {
      console.log("Accounts_List_Js.registerEvents() called");

      // Call parent registerEvents
      this._super();

      console.log("Parent registerEvents done");

      // Append contacts count after page load
      var thisInstance = this;

      // Use setTimeout to wait for DOM to be ready
      setTimeout(function () {
        console.log("Timeout 500ms - calling appendContactsCount");
        thisInstance.appendContactsCount();
      }, 500);

      // Also listen to Vtiger's list view loaded event
      jQuery(document).on("Vtiger.List.LoadComplete", function () {
        thisInstance.appendContactsCount();
      });

      // Setup MutationObserver for future updates
      var setupObserver = function () {
        var listViewTable = jQuery("#listview-table");
        if (listViewTable.length > 0) {
          var observer = new MutationObserver(function (mutations) {
            thisInstance.appendContactsCount();
          });

          observer.observe(listViewTable[0], {
            childList: true,
            subtree: true,
          });
        } else {
          setTimeout(setupObserver, 1000);
        }
      };

      setTimeout(setupObserver, 1000);
    },
  }
);
