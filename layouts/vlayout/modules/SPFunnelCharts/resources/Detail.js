/*+**********************************************************************************
 * Advanced Funnel Charts by SalesPlatform
 * Copyright (C) 2011-2016 SalesPlatform Ltd
 * All Rights Reserved.
 * This extension is licensed to be used within one instance of Vtiger CRM.
 * Source code or binaries may not be redistributed unless expressly permitted by SalesPlatform Ltd.
 * If you have any questions or comments, please email: extensions@salesplatform.ru
 ************************************************************************************/

Vtiger_DashBoard_Js("SPFunnelCharts_Detail_Js",{},{
       
    registerEvents : function(){
        this.registerGridster();
        this.loadWidgets();
        this.registerRefreshWidget();
        this.showWidgetIcons();
        this.hideWidgetIcons();
    }
});