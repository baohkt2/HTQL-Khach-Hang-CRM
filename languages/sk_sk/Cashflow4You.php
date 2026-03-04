<?php
/* * *******************************************************************************
 * The content of this file is subject to the Cashflow4You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

$languageStrings = Array(
    'Cashflow4You' => 'Pokladňa',
    'SINGLE_Cashflow4You' => 'Pokladňa',
    'Cashflow4You ID' => 'Pokladňa ID',
    
    'LBL_MODULE_NAME' => 'Pokladňa',
    'LBL_ADD_RECORD' => 'Vytvoriť Platbu',
    'LBL_RECORDS_LIST' => 'Pokladňa List',
    'LBL_CASHFLOW_INFORMATION' => 'Informácie o Platbe',
    'LBL_CUSTOM_INFORMATION' => 'Zákaznícke Informácie',
    'LBL_MODULEBLOCK_INFORMATION' => 'ModuleBlock Information',
    'LBL_TAX_INFORMATION' => 'Informácie o účte',
    
    'ModuleFieldLabel' => 'ModuleFieldLabel Text',
    
    'Cashflow4You Name' => 'Názov Platby',
    'Cashflow4You No' => 'Číslo Platby',
    'Payment Date' => 'Dátum Platby',
    'Payment Method' => 'Spôsob Platby',
    'Paid Amount' => 'Hodnota',
    'Relation' => 'Platba za',
    'Transaction ID' => 'Číslo Tranzakcie',
    'Due Date' => 'Dátum Splatnosti',
    'Currency' => 'Mena',
    'Payment Type' => 'Typ Platby',
    'Payment Category' => 'Kategória',
    'Related To' => 'Vzťahuje sa na',
    'Created Time' => 'Čas Vytvorenia',
    'Modified Time' => 'Čas Zmeny',
    'Payment Mode' => 'Payment Mode',
    'Payment Subcategory' => 'Podkategória Platby',
    'Payment Status' => 'Stav Platby',
    'Description' => 'Popis',
    'Accounting Date' => 'Dátum Zaúčtovania',
    'VAT' => 'DPH',
    'Price without VAT' => 'Cena bez DPH',
    'Tax Component' => 'Daňová Položka',
    'Assigned To' => 'Pridelený k',
    'Associated No' => 'Associated No',
    'Remaining Amount' => 'Neuhradené',
    'Relations' => 'Platba pridelena k',
    
    'Create_Payment' => 'Vytvoriť platbu',
    'LBL_CASHFLOW_SAME_ORGA' => 'Organizácie musia byť rovnaké.',
    
    'relation_am'=>'Suma',
    'invoice_am' => 'Suma na faktúre',
    'po_am' => 'Suma na objednávke',
    'paid' => 'Zaplatené',
    'Paid' => 'Zaplatené',
    'to_pay' => 'Ostáva zaplatiť',
    'LOAD_PAYMENTS' => 'Zobraziť platby',
    'p_pending'=>'Očakávaná',
    'Pending' => 'Meškajúca',
    'Waiting' => 'Očakávané',
    'Received' => 'Prijatá',
    'Created' => 'Vytvorená',
    'Add_Payment' => 'Vytvoriť platbu',
    // ITS4YOU-CR SlOl 10/31/2011 9:32:06 
    'paytype'=>'Typ platby',
    'Incoming'=>'Prijatá',
    'Outgoing'=>'Odoslaná',
    'Multiple_Payment' => 'Viacnásobná platba',
    'PaymentDetails' => 'Detaily platby',

    'Relation_Nr' => 'Číslo prisluchajúceho záznamu',
    'RelatedInformation' => 'Informácie o platbách',
    'Cost' => 'Poplatky',
    'Total_Amount' => 'Celková suma',
    'Other' => 'Iný',
    'Income_for_services' => 'Príjem za služby',
    'Income_for_products' => 'Príjem za produkty',
    'Office_cost' => 'Náklady na kanceláriu',
    'Telephone' => 'Telefón',
    'Salaries' => 'Mzdy',
    'Wages' => 'Odmeny',
    'Rent' => 'Nájom',
    'Fuel' => 'Palivo',
    

    'INFO_RELATED_STATUS_CHANGE' => 'Stav príslušnej faktúry bude zmenený na '.getTranslatedString('Paid','Invoice'),
    'negative_check_alert' => 'Zaplatená suma by mala byť pri odchádzajúcich platbách záporné číslo',
    'not_negative_check_alert' => 'Zaplatená suma by mala byť pri prijatých platbách kladné číslo',

    'cf4youcash' => 'Pokladňa',
    'Cashflow' => 'Pokladňa',
    'Cash' => 'Hotovosť',
    'Bank account' => 'Bankový Účet',
    'Bank Transfer' => 'Bankový Prevod',
    'Invoice' => 'Faktúra',
    'Credit card' => 'Kreditná karta',
    'accountingdate' => 'Dátum Zaúčtovania',
    
    'LBL_CASHFLOW_ADD_INVOICE' => getTranslatedString('LBL_ADD_RECORD','Invoice'),

    //Select Wizard ERR
    'LBL_CASHFLOW_SAME_ORGA' => 'Organizácia musí byť rovnaká',
    
    //quick casflow create
    'LBL_CASHFLOW_SUMMARY' => 'Zhrnutie',
    'LBL_CASHFLOW_BALANCE' => 'Zostatok',
    'LBL_CASHFLOW_PAYMENT' => 'Platba',
    'LBL_CASHFLOW_ALREADY_PAYD' => 'Už Zaplatené',
    'LBL_CASHFLOW_OUTSTANDING_BALANCE' => 'Zostatok', //zostatok
    'LBL_CASHFLOW_OPEN_AMOUNT' => 'Neuhradené',
    'LBL_PAY_OFF' => 'Vyplatiť',

    //error
    'LBL_CASHFLOW_IS_NAN' => 'je neplatný',
    'LBL_CASHFLOW_HIGH' => 'Vysoká',
    'LBL_CASHFLOW_CHANGE_PAYMENT_QUEST' => 'Ste si istý že chcete zmeniť platbu?',
    'LBL_CASHFLOW_BALLANCE_OUT_RANGE' => 'Balance Payment must be zero',

    'LBL_CASHFLOW_IS_SAVED' => 'je uložená',
    'LBL_CASHFLOW_SAVE_ERROR' => 'Pokladňa chyba pri ukladaní.',
    
    //installation
    "LBL_INSTALL" => "inštalácia",
    "LBL_VALIDATION" => "Overenie",
    "LBL_FINISH" => "Koniec",
    "LBL_WELCOME" => "Vitajte v sprievodcovi inštaláciou Pokladne",
    "LBL_WELCOME_DESC" => "Týmto nainštalujete Pokladňu do vášho vtiger CRM.",
    "LBL_WELCOME_FINISH" => "Je potrebné dokončiť inštaláciu bez akéhokoľvek prerušenia.",
    "LBL_INSERT_KEY" => "Prosím zadajte licenčný kľúč, ktorý ste dostali v emaile s potvrdením objednávky.",
    "LBL_LICENSE_KEY" => "Licenčný kľúč",
    "LBL_ACTIVATE_KEY" => "Aktivuj licenciu",
    "LBL_VALIDATE" => "Overiť",
    "LBL_ONLINE_ASSURE" => "Prosím skontrolujte či váš počítač má pripojenie k internetu, aby sa mohlo uskutočniť overenie.",
    "LBL_ORDER_NOW" => "Objednajte si teraz",
    "LBL_INVALID_KEY" => "Nesprávny licenčný kľúč! Kontaktujte prosím predajcu Pokladne.",
    "LBL_INSTALL_SUCCESS" => "Pokladňa bola úspešne nainštalovaná.",
    
    "LBL_LICENSE" => "Licenčné nastavenia",
    "LBL_LICENSE_DESC" => "Správa všetkých nastavení licencie pokladne.",
    "LBL_REACTIVATE" => "Reaktivácia licencie",
    "REACTIVATE_SUCCESS" => "Úspešne ste reaktivovali vášu Pokladňu.",
    "LBL_DEACTIVATE" => "Deaktivovať licenciu",
    "LBL_DEACTIVATE_TITLE" => "Deaktivovať licenciu",
    'LICENSE_SETTINGS' => 'Licenčné nastavenia',
    'LICENSE_SETTINGS_INFO' => 'Správa všetkých nastavení licencie pokladne.',
    
    "LBL_INACTIVE" => "Pokladňa je neaktivovaná. Prosím zadajte licenčný kľúč.",
    "LBL_DEACTIVATE_SUCCESS" => "Licenčný kľúč bol úspešne deaktivovaný.",
    "LBL_REACTIVATE_DESC" => "V prípade, že sa vyskytne problém s licenčným kľúčom.",
    
    // integration
    "LBL_INTEGRATION" => "Integrácia",
    "LBL_INTEGRATION_DESC" => "Integrácia Pokladne do iných modulov",
    "INTEGRATION" => "Integrácia",
    "LBL_AVAILABLE_MODULES" => "Dostupné moduly",
    
    //uninstal
    "LBL_UNINSTALL" => "Odinštalovať",
    "LBL_UNINSTALL_DESC" => "Odstrániť Pokladňu kompletne z vtiger.",
    
    "ITS4YouPreInvoice" => "Zálohová faktúra",
    "CreditNotes4You" => "Dobropis",
    
    "Create Payment" => "Vytvoriť platbu",
    "Payments" => "Platby",
    "Grand Total" => "Celkom",
    "Total amount" => "Zaplatené",
    "Balance" => "Zostatok",
    
    "LBL_COMPANY_LICENSE_INFO" => "Vaše informácie o firme",
    "LBL_URL" => "Vaša vtiger url adresa",
    "LBL_CHANGE_COMPANY_INFORMATION" => "Zmeniť Informácie o spoločnosti",
    "LBL_LICENSE_SETTINGS_INFO" => "Správa Vášho licenčneho kľúča",
);

$jsLanguageStrings = array(
    "LBL_DEACTIVATE_QUESTION" => "Určite chcete deaktivovať Váš licenčný kľúč?",
    "LBL_UNINSTALL_CONFIRM" => "Naozaj chcete úplne odstrániť Pokladňu z vášho vtiger a deaktivovať licenciu Pokladne?",
);
?>
