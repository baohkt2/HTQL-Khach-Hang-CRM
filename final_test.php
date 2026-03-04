<?php
// Final test - check latest imported contacts
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'vtiger';

try {
    $mysqli = new mysqli($host, $username, $password, $database);
    
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }
    
    echo "=== Latest Import Results ===\n\n";
    
    // Get contacts created today
    $contactQuery = "SELECT 
        c.contactid, 
        c.firstname, 
        c.lastname, 
        c.mobile,
        ccf.cf_1404 as mobile_networks,
        ce.createdtime
    FROM vtiger_crmentity ce
    JOIN vtiger_contactdetails c ON ce.crmid = c.contactid
    LEFT JOIN vtiger_contactscf ccf ON c.contactid = ccf.contactid
    WHERE ce.deleted = 0 
    AND c.mobile IS NOT NULL 
    AND c.mobile != ''
    AND DATE(ce.createdtime) = CURDATE()
    ORDER BY ce.createdtime DESC 
    LIMIT 20";
    
    $result = $mysqli->query($contactQuery);
    
    if ($result->num_rows > 0) {
        printf("%-8s %-15s %-15s %-12s %-15s %-20s\n", "ID", "First Name", "Last Name", "Mobile", "Networks", "Created");
        echo str_repeat("-", 90) . "\n";
        
        $workingCount = 0;
        while ($row = $result->fetch_assoc()) {
            $networks = $row['mobile_networks'] ?: 'NULL';
            $marker = ($row['mobile_networks']) ? '✅' : '❌';
            
            printf("%s %-7s %-15s %-15s %-12s %-15s %-20s\n", 
                $marker,
                $row['contactid'], 
                substr($row['firstname'] ?: '', 0, 14), 
                substr($row['lastname'] ?: '', 0, 14), 
                $row['mobile'], 
                $networks,
                $row['createdtime']
            );
            
            if ($row['mobile_networks']) {
                $workingCount++;
            }
        }
        
        echo "\nSummary:\n";
        echo "- Total contacts today: " . $result->num_rows . "\n";
        echo "- Workflow working: $workingCount\n";
        echo "- Workflow not working: " . ($result->num_rows - $workingCount) . "\n";
        
        if ($workingCount > 0) {
            echo "\n🎉 WORKFLOW IS WORKING! Mobile networks field is being populated!\n";
        } else {
            echo "\n⚠️  Workflow still not working. Mobile networks field is empty.\n";
            echo "\nTroubleshooting steps:\n";
            echo "1. Check that Vietnam Mobile Carrier Prefix Mapping workflow is active\n";
            echo "2. Verify workflow conditions and tasks\n";
            echo "3. Import single_test.csv and check logs\n";
        }
        
    } else {
        echo "No contacts with mobile numbers created today.\n";
        echo "Please check if import was successful.\n";
    }
    
    $mysqli->close();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>