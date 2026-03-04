/*+***********************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
*************************************************************************************/

let ITS4YouProjectsChart_HS = {
    initialize: function () {
        this.registerLinkButton();
    },

    getContainer: function () {
        return jQuery('.module-action-bar').find('.navbar-right');
    },

    registerLinkButton: function () {
        let self = this;

        let moduleName = app.getModuleName();

        if ('ITS4YouProjectsChart' === moduleName
            || 'Project' === moduleName
        ) {
            let containerFluid = self.getContainer();

            if (0 < containerFluid.length) {
                let params = {
                    data: {
                        module: 'ITS4YouProjectsChart',
                        view: 'IndexAjax',
                        mode: 'getProjectListButton',
                        source_module: moduleName
                    }
                };

                app.request.post(params).then(function (error, data) {
                    if (!error) {
                        self.addButton(data);
                    }
                });
            }
        }
    },

    addButton: function (buttonHtml) {
        let self = this;

        if ('' !== buttonHtml) {
            let containerFluid = self.getContainer();

            containerFluid.find('.navbar-nav');
            containerFluid.find('li').first().before('<li>' + buttonHtml + '</li>');
            self.registerLinkAction();
        }
    },

    registerLinkAction: function () {
        $('#Project_listView_basicAction_Projects_Chart').on('click', function () {
            window.location.href = $(this).data('url');
        });
        $('#Project_listView_basicAction_Projects_List').on('click', function () {
            window.location.href = $(this).data('url');
        });
    }
};

ITS4YouProjectsChart_HS.initialize();
