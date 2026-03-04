<?php

class Settings_ITS4YouInstaller_Login_View extends Settings_ITS4YouInstaller_Extensions_View
{
    public function process(Vtiger_Request $request)
    {
        $module = $request->getModule();
        $qualifiedModule = $request->getModule(false);

        $viewer = $this->getViewer($request);

        $viewer->assign('QUALIFIED_MODULE', $qualifiedModule);
        $viewer->assign('MODULE', $module);
        $viewer->assign('SHOP_LINK', $this->getShopLink());
        $viewer->view('Login.tpl', $qualifiedModule);
    }
}